<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        dd('BasketController->index');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('here');
        $this->validate($request,[
            'id' =>'required|numeric',
        ]);
        $this->pro = Product::findOrFail($request['id']);
        if($this->pro->count == 0 )
            return response()->json(['success' => false,'msg'=>__('out of stock ')],200);

        var_dump($this->IsBasket($request['id']));die;
        if(!($this->IsBasket($request['id'])) ){
            dd('here');
            $basket = new Basket();
            $basket->products_id  = $request['id'];
            $basket->users_id = $this->user_id;
            $basket->count = 1;
            $basket->save();
        }
        $show_plus_btn = ($this->pro->count - 1) > 0 ? 1 : 0;
        $view = view($request['view'], ['show_add_basket' =>0 ,'number_basket'=> 1,'show_plus_btn'=>$show_plus_btn,'product'=>$this->pro])->render();
        response()->json(['success' => true,'msg'=>__('Added to basket '),'view' => $view], 200)->throwResponse();
    }


    public function IsBasket($id){
        dd('basket');
        $result = Basket::select('count')->where('products_id','=',$id)->where('users_id','=',$this->user_id)->get();
        return !empty($result->count) ? $result->count : 0 ;
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

    }


}
