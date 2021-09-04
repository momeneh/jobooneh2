<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductsImages;
use App\Notifications\ProductChanged;
use App\Notifications\ProductCreated;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __cunstruct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $result = Product::orderBy('id','DESC')->where('user_id','=',Auth::user()->id);
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
        $categories = Categories::UserProductListCategories();
        return view('user_product.index',['list'=> $result,'request'=>$request,'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Categories::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        return view('user_product.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required|numeric',
            'title' => 'required|min:3',
            'image.*' => 'required'
        ]);
        $record = new product();
        $this->SetAttriburtes($record,$request);
        $record->confirmed = 0;
        $record->save();

        $alts = $request->input('alt', []);
        $images = $request->input('image', []);
        for ($i=0; $i < count($images); $i++) {
            $pr_im = new ProductsImages(['image'=>$images[$i],'alt' => !empty($alts[$i]) ? $alts[$i] : '']);
            $record->images()->save($pr_im);
        }

        Notification::send(Admin::all(), new ProductCreated($record,Auth::user()));//for admins to confirm the product
        Notification::send(Auth::user(), new ProductCreated($record,'owner'));//for user to wait the product confirmation
        return redirect()->route('userProduct.index')->with('message', __('messages.created'));
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
    public function edit($id)
    {
        $product = Product::findOrfail($id);
        $this->authorize('update',$product )    ;
        $categories = Categories::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        $product->load('images');

        return view('user_product.edit',compact('product','categories'));
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
        $record = Product::findOrFail($id);
        $this->authorize('update',$record )    ;

        $this->validate($request,[
            'category_id' => 'required|numeric',
            'title' => 'required|min:3',
            'image.*' => 'required'
        ]);

        $record->title = $request['title'];
        $record->user_id = Auth::id();
        $record->categories_id = $request['category_id'];
        $record->description = $request['description'];
        $record->sell_status = $request['sell_status'];
        $record->pre_pay = $request['pre_pay'];
        $record->duration_of_work = $request['duration'];
        $record->price = $request['price'];
        $record->lang_id = Helper::GetLocaleNumber();
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

        $this->NotifyAdmin($record);

        return redirect()->route('userProduct.index')->with('message', __('messages.updated'));

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
        $this->authorize('delete',$pro )    ;
        $images = $pro->images()->get();

        foreach ($images as $i){
            //1:remove images files
            $file = 'product_images/'.$i['image'];
            if(Storage::exists($file))   Storage::delete($file);
        }
        //2:remove details
        $i->where('products_id','=', $id)->delete();

        //3:remove Pro
        $pro->delete();
        return back()->with('message', __('messages.deleted'));
    }


    public function UploadFile(Request $request){
        $i = preg_replace('/[^0-9]*/', '', array_keys($request->all())[0]);
        $var_name = 'uploadfile'.$i;
        $this->validate($request,[
            $var_name =>'required|image|mimes:jpeg,png,jpg|max:8192'
        ]);
        if($request->hasFile($var_name) && $request->file($var_name)->isValid()) {//no problems uploading the file
            // image file
            $name =  Auth::id().'u_'.date("Y-m-d-h-i-s")  . '.' . $request->file($var_name)->extension();
            $request->$var_name->storeAs('product_images',$name);
            return response()->json(['success' => true, 'file' => asset('/product_images/'.$name),'name'=>$name],200);
        }else{
            return response()->json(['success' => false, 'msg' => __('there was problem with the file')],200);
        }
    }

    public function RemoveFile(Request $request){
        $this->validate($request,[
            'img' =>'required'
        ]);

        $file = 'product_images/'.basename($request['img']);
        if(Storage::exists($file)){
            if(Storage::delete($file)){
                return response()->json(['success' => true],200);
            }else{
                return response()->json(__('could not delete file'),304);
            }
        }else{
            return response()->json( __('file not exists '),404);
        }
    }

    private function NotifyAdmin($record){
        //if a product is confirmed and owner edit it a notification to admins send to check the product again
        $st_changed = [];
        if($record->confirmed == 1 ){
            foreach(array_keys($record->getChanges()) as $title) {
                $st_changed[] = __('messages.filed_changed',['field_title'=>$title]) ;
            }
            Notification::send(Admin::all(), new ProductChanged($record,Auth::user(),$st_changed));//for admins to check the product
        }
    }

    private function SetAttriburtes(&$record,$request){
        $record->title = $request['title'];
        $record->user_id = Auth::id();
        $record->categories_id = $request['category_id'];
        $record->description = $request['description'];
        $record->sell_status = $request['sell_status'];
        $record->pre_pay = $request['pre_pay'];
        $record->duration_of_work = $request['duration'];
        $record->price = $request['price'];
        $record->lang_id = Helper::GetLocaleNumber();

    }
}
