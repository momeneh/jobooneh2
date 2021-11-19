<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TmpBasketController extends Controller implements BasketContract
{
    private $pro;


    public function store(Request $request)
    {
        dd('ttemp');
        $this->validate($request,[
            'id' =>'required|numeric',
        ]);
        $this->pro = Product::findOrFail($request['id']);
        if($this->pro->count == 0 )
            return response()->json(['success' => false,'msg'=>__('out of stock ')],200);

        if(!($this->IsBasket($request['id'])) ){
            setcookie('tmp_basket_pro_id_'.$request['id'],1, time() + (60 * 60 * 48), "/");//for 2 day tmp basket
        }
        $show_plus_btn = ($this->pro->count - 1) > 0 ? 1 : 0;
        $view = view($request['view'], ['show_add_basket' =>0 ,'number_basket'=> 1,'show_plus_btn'=>$show_plus_btn,'product'=>$this->pro])->render();
        response()->json(['success' => true,'msg'=>__('Added to basket '),'view' => $view], 200)->throwResponse();
    }

    public function update(Request $request, $id)
    {
        $this->pro = Product::findOrFail($request['id']);
        if (!isset($_COOKIE['tmp_basket_pro_id_'.$id]))
            return response()->json(['success' => false,'msg'=>__('something is wrong .pls refresh the page')],200);

        $count = $_COOKIE['tmp_basket_pro_id_'.$id]+1;
        $show_plus_btn = ($this->pro->count - $count) > 0 ? 1 : 0;
        setcookie('tmp_basket_pro_id_'.$id,$count, time() + (60 * 60 * 48), "/");//for 2 day tmp basket

        $view = view($request['view'], ['show_add_basket' =>0 ,'number_basket'=>$count ,'show_plus_btn'=>$show_plus_btn,'product'=>$this->pro])->render();
        response()->json(['success' => true,'msg'=>'','view' => $view], 200)->throwResponse();
    }

    public function destroy($id,Request $request){
        $this->pro = Product::findOrFail($id);
        if(!$request->ajax()){
            unset($_COOKIE['tmp_basket_pro_id_'.$id]);
            return back();
        }
        if (!isset($_COOKIE['tmp_basket_pro_id_'.$id]))
            return response()->json(['success' => false,'msg'=>__('something is wrong .pls refresh the page')],200);

        $view = view($request['view'], ['show_add_basket' =>1 ,'number_basket'=> 0,'show_plus_btn'=>1,'product'=>$this->pro])->render();
        $response = new Response(json_encode(['success' => true,'msg'=> '','view' => $view], 200));

        unset($_COOKIE['tmp_basket_pro_id_'.$id]);
        $response->withCookie('tmp_basket_pro_id_'.$id,0,time() - (60 * 60 * 48))
            ->throwResponse();
        return $response;
    }

    public  function IsBasket($id){
        return isset($_COOKIE['tmp_basket_pro_id_'.$id]) && $_COOKIE['tmp_basket_pro_id_'.$id]>0 ?  $_COOKIE['tmp_basket_pro_id_'.$id] : 0 ;
    }

    public function Index(Request $request)
    {
        $list = [];
       foreach($_COOKIE as $name => $value){
           if(!is_numeric($value)) continue;
           if(  strpos($name,'tmp_basket_pro_id') === false) continue;

           $id = substr($name,18,strlen($name));
           $list[$id] = $value;
           $pros[] = $id;
       }
       if(empty($pros))
           return view('basket.index',['list'=> []]);

       $owners = Product::GetBasketProducts($pros,'owners');


       $result = Product::GetBasketProducts($pros);
       foreach ($result as &$product){
           $product->basket_count = $list[$product->id];
           $product->show_plus_btn = $product->count - $product->basket_count > 0 ? 1 : 0;
       }
       return view('basket.index',['list'=> $result,'basket'=>$list,'owners'=>$owners]);
    }
}
