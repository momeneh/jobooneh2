<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use http\Params;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Faker\Factory as Faker;

class ProductController extends Controller
{
    public function __cunstruct(){
    }


    public function categories()
    {
        $result = Categories::CategoriesProductCount(1000);
        $result->where('lang_id','=',Helper::GetLocaleNumber());
        return view('site_products.categories',['categories'=> $result]);
    }

    public function cat_products($id,Request $request){
        $category = Categories::findOrFail($id);
        $category = array_reverse($category->getParentsNames());

        $result = Product::GetProductsByCatId($id);
        if($request->ajax()) {
            //ajax paging
            $view = view('site_products.cat_products_list', ['products' => $result])->render();
            return response()->json(['view' => $view], 200)->throwResponse();
        }
        return view('site_products.cat_products',['products'=> $result,'category'=>$category]);
    }

    public function show($id,Request $request){
//              Comment::factory(20)->create();
        $comments = $this->LoadComments($id,$request);

        $product = Product::findOrFail($id);
        $product->timestamps = false;
        $product->visited_count  = $product->visited_count+1;
        $product->save();

        $product->load('images','owner','category');
        if(app()->getLocale() == 'fa' ) {
            $product->price = Helper::toPersianNum(number_format($product->price));
            $product->pre_pay = Helper::toPersianNum(number_format($product->pre_pay));
        }
        if($product->sum_rate > 0 )
            $product->rate = round($product->sum_rate / $product->count_rate,0);
        else $product->rate = 0;
        return view('site_products.product',['product'=> $product,'comments'=>$comments]);
    }

    private function LoadComments($pro_id,$request){
        $comments = Comment::where('products_id',$pro_id)->orderBy('id','DESC')->cursorPaginate(5);
        if($request->ajax()) {
            if(!empty($comments)) {
                $view = view('comment.list', ['comments' => $comments])->render();
                response()->json(['view' => $view], 200)->throwResponse();
            }
        }
        return $comments;
    }

    public function rateStore(Request $request){
        $this->validate($request,[
            'id' =>'required|numeric|exists:App\Models\Product,id',
            'rate' => 'required|numeric',
        ]);
        if(!empty($_COOKIE['star_pro_id_'.$request['id']]) ){
            return response()->json(['success'=>false,'msg'=>__('you have rated before to this item ')],200);
        }
        setcookie('star_pro_id_'.$request['id'],'1', time() + (60 * 60), "/");//for one hour can not rate
        $pro = Product::findOrFail($request['id']);
        $pro->count_rate = $pro->count_rate+1;
        $pro->sum_rate = $pro->sum_rate+$request['rate'];

        $pro->save();
        return response()->json(['success' => true,'msg'=>__('thank you for rating to this item ')],200);

    }

    public function commentStore(Request $request){
        $this->validate($request,[
            'product_id' =>'required|numeric|exists:App\Models\Product,id',
            'email' =>'nullable|email',
            'comment' => 'required|min:5',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);
        $comment = new Comment(['name'=>$request['name'],'email'=>$request['email'],'comment'=>$request['comment']]);
        $pro = Product::findOrFail($request['product_id']);
        $pro->comments()->save($comment);
        return back()->with('message', __('messages.message_sent'));

    }

    public function Owner($id,Request $request){
        $owner = User::findOrFail($id);

        $products = Product::GetProductsByOwnerId($id);
        if($request->ajax()) {
            //ajax paging
            $view = view('site_products.cat_products_list', ['products' => $products])->render();
            return response()->json(['view' => $view], 200)->throwResponse();
        }
        return view('site_products.owner',['owner'=> $owner,'products'=>$products]);
    }

    public function search(Request $request){
        if(empty($request->search_key)) return back();
        $result = Product::GetProductsSearch($request);
        if($request->ajax()) {
            //ajax paging
            $view = view('site_products.cat_products_list', ['products' => $result])->render();
            return response()->json(['view' => $view], 200)->throwResponse();
        }

        $cats = ArrayToTree(Product::GetCategoriesSearch($request->search_key)->all());
        $owners = Product::GetOwnersSearch($request->search_key);
        return view('site_products.search',['products'=> $result,'request'=>$request,'categories'=>$cats,'owners'=>$owners]);
    }

}
