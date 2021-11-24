<?php

namespace App\Http\Controllers\basket;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller implements BasketContract
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $owners = Product::GetBasketProducts('','owners',false);

        $result = Product::GetBasketProducts('','',false);

        foreach ($result as $product){
            $product->show_plus_btn = $product->count - $product->basket_count > 0 ? 1 : 0;
        }
        return view('basket.index',['list'=> $result,'owners'=>$owners]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id' =>'required|numeric',
        ]);
        $this->pro = Product::findOrFail($request['id']);
        if($this->pro->count == 0 )
            return response()->json(['success' => false,'msg'=>__('out of stock ')],200);

        if(!($this->IsBasket($request['id'])) ){
            $basket = new Basket();
            $basket->products_id  = $request['id'];
            $basket->users_id = auth()->id();
            $basket->count = 1;
            $basket->save();
        }
        $show_plus_btn = ($this->pro->count - 1) > 0 ? 1 : 0;
        $view = view($request['view'], ['show_add_basket' =>0 ,'number_basket'=> 1,'show_plus_btn'=>$show_plus_btn,'product'=>$this->pro])->render();
        response()->json(['success' => true,'msg'=>__('Added to basket '),'view' => $view], 200)->throwResponse();
    }


    public function IsBasket($id){
        $result = Basket::select('count')->where('products_id','=',$id)->where('users_id','=',auth()->id())->first();
        return !empty($result->count) ? $result->count : 0;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pro = Product::findOrFail($request['id']);

        $basket = Basket::where('products_id','=',$id)->where('users_id','=',auth()->id())->first();
        if (empty($basket->id))
            return response()->json(['success' => false,'msg'=>__('something is wrong .pls refresh the page')],200);

        $basket->count = $basket->count+1;
        $show_plus_btn = ($pro->count - $basket->count) > 0 ? 1 : 0;

        $basket->save();

        $view = view($request['view'], ['show_add_basket' =>0 ,'number_basket'=>$basket->count ,'show_plus_btn'=>$show_plus_btn,'product'=>$pro])->render();
        response()->json(['success' => true,'msg'=>'','view' => $view], 200)->throwResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $pro = Product::findOrFail($id);
        $basket = Basket::where('products_id','=',$id)->where('users_id','=',auth()->id())->first();
        if (empty($basket->id))
            return response()->json(['success' => false,'msg'=>__('something is wrong .pls refresh the page')],200);

        $basket->delete();

        $view = view($request['view'], ['show_add_basket' =>1 ,'number_basket'=> 0,'show_plus_btn'=>1,'product'=>$pro])->render();
        response()->json(['success' => true,'msg'=>'','view' => $view], 200)->throwResponse();
    }


}
