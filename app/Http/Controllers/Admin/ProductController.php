<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductsImages;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Faker\Factory as Faker;

class ProductController extends Controller
{
    public function __cunstruct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        Product::factory(10)->create();
//        $faker = Faker::create('App\User');
//        DB::table('users')->update([
//            'description' => $faker->sentence()]);

        $result = Product::orderBy('id','DESC');
        if($request->title) $result = $result->where('title','LIKE','%'.$request->title.'%');
        if($request->id) $result = $result->where('id','=',$request->id);
        if(trim($request->active) == 2) $result = $result->where('confirmed','=',0);
        if(trim($request->active) == 1) $result = $result->where('confirmed','=',1);
        if($request->owner) {
            $result = $result->whereHas('Owner', function ( $query) use ($request) {
                $query->where('name', 'like', '%'.$request->owner.'%');
            });
        }
        if($request->categories_id) $result = $result->where('categories_id','=',$request->categories_id);
        if($request->sell_status) $result = $result->where('sell_status','=',$request->sell_status);
        if($request->price) $result = $result->where('price','=',$request->price);

        $result->where('lang_id','=',Helper::GetLocaleNumber());

        $result = $result->paginate(10);
        $categories = $this->Categories();
        return view('product.index',['list'=> $result,'request'=>$request,'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Categories::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        return view('product.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $m= __('messages.owner_required');
        $this->validate($request,[
            'owner_id' =>'required|numeric|exists:App\Models\User,id',
            'category_id' => 'required|numeric',
            'title' => 'required|min:3',
            'image.*' => 'required'
        ],['owner_id.required'=>$m,'owner_id.numeric'=>$m,'owner_id.exists'=>$m]);

        $record = new product();
        $record->title = $request['title'];
        $record->user_id = $request['owner_id'];
        $record->categories_id = $request['category_id'];
        $record->description = $request['description'];
        $record->confirmed = empty($request['confirmed']) ? 0 : 1;
        $record->sell_status = $request['sell_status'];
        $record->pre_pay = $request['pre_pay'];
        $record->duration_of_work = $request['duration'];
        $record->price = $request['price'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->count = $request['count'];
        $record->save();
        Storage::put('product_count_logs/'.$record->id.'.txt',Carbon::now().': ----' .$record->count . ' inserted to db ----');//count_log

        $alts = $request->input('alt', []);
        $images = $request->input('image', []);
        for ($i=0; $i < count($images); $i++) {
            $pr_im = new ProductsImages(['image'=>$images[$i],'alt' => !empty($alts[$i]) ? $alts[$i] : '']);
            $record->images()->save($pr_im);
        }

        if($record->confirmed == 1 ) User::SetOwner($record->user_id);
        return redirect()->route('product.index')->with('message', __('messages.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories = Categories::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        $product->load('images','owner');
        $log = Storage::exists('product_count_logs/'.$product->id.'.txt') ?  Storage::get('product_count_logs/'.$product->id.'.txt') : '';
        return view('product.edit',compact('product','categories','log'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $m= __('messages.owner_required');
        $this->validate($request,[
            'owner_id' =>'required|numeric|exists:App\Models\User,id',
            'category_id' => 'required|numeric',
            'title' => 'required|min:3',
            'image.*' => 'required'
        ],['owner_id.required'=>$m,'owner_id.numeric'=>$m,'owner_id.exists'=>$m]);

        $record = Product::findOrFail($id);
        $before_confirmed = $record->confirmed;
        if($record->count != $request['count'])
            Storage::append('product_count_logs/'.$record->id.'.txt', Carbon::now().': ---- the owner changed count to  ' .$request['count'] . '  ---- ');
        $record->title = $request['title'];
        $record->user_id = $request['owner_id'];
        $record->categories_id = $request['category_id'];
        $record->description = $request['description'];
        $record->confirmed = empty($request['confirmed']) ? 0 : 1;
        $record->sell_status = $request['sell_status'];
        $record->pre_pay = $request['pre_pay'];
        $record->duration_of_work = $request['duration'];
        $record->price = $request['price'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->count = $request['count'];
        $record->save();

        $alts = $request->input('alt', []);
        $images = $request->input('image', []);
        $ids = $request->input('id', []);
        $record->images()->whereNotIn('id', $ids)->delete();
        $up_arr = [];
        for ($i=0; $i < count($images); $i++) {
            $up_arr[] = ['id'=>$ids[$i] , 'image' => $images[$i] , 'alt'=>$alts[$i],'products_id'=>$id];
        }
        $record->images()->upsert($up_arr,['id'],['image','alt']);

        if( (empty($before_confirmed) || $before_confirmed!= 1) && $record->confirmed == 1 ) User::SetOwner($record->user_id);
        return redirect()->route('product.index')->with('message', __('messages.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $pro =  Product::findOrFail($id);
        if($pro->Baskets()->count()){
            return back()->with('error', __('messages.can_not_delete_for_basket'));
        }
        Storage::delete('file.jpg');

        if(Storage::exists('product_count_logs/'.$pro->id.'.txt'))
            Storage::delete('product_count_logs/'.$pro->id.'.txt');

        $images = $pro->images()->get();

        foreach ($images as $i){
            //1:remove images files
            $file = 'product_images/'.$i['image'];
            if(Storage::exists($file))   Storage::delete($file);
        }
        DB::transaction(function () use ($pro) {
            //2:remove details
            $pro->images()->delete();

            //3:remove Pro
            $pro->delete();
        });
        return back()->with('message', __('messages.deleted'));
    }

    private function Categories(){
        return DB::table('categories AS a')
            ->select('a.id','a.title')
            ->join('products As p', 'a.id', '=', 'p.categories_id')
            ->groupBy('a.id','a.title')
            ->get();
    }

    public function UploadFile(Request $request){
        $i = preg_replace('/[^0-9]*/', '', array_keys($request->all())[0]);
        $var_name = 'uploadfile'.$i;
        $name =  Auth::id().'_'.date("Y-m-d-h-i-s")  . '.' . $request->file($var_name)->extension();
        $file = new FileController('required|image|mimes:jpeg,png,jpg|max:8192','product_images/',$var_name,$name);
        return $file->UploadFile($request);
    }

    public function RemoveFile(Request $request){
        $file = new FileController('required','product_images/','img','');
        return $file->RemoveFile($request);
    }
}
