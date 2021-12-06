<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Order::all();
        return view('order.index',['list'=> $result]);
    }

    private function CheckOrderConditions($request){
        $result = Product::GetBasketProducts($request['products'],'shop_page',false);
        if(empty($result[0]->user_id) || $result[0]->user_id != $request['owner_id']) //because shop is based on owners
            return back()->with('message', __('something is wrong .pls refresh the page'))->throwResponse();
        foreach ($result as $bas_pro){
            if(!($bas_pro->count >0 ) )
                return back()->with('message', __('messages.product_out_of_stock',['name_pro'=>$bas_pro->title]))->throwResponse();

        }

        if(empty(auth()->user()->address) || empty(auth()->user()->postal_code))
            return back()->with('message', __('Please insert your address,postal code data in your profile page '))->throwResponse();

        return $result;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $result = $this->CheckOrderConditions($request);
        return view('order.create',['list'=> $result]);
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
            'receipt' =>'required|image|mimes:jpeg,png,jpg|max:8192',
        ]);
        $result = $this->CheckOrderConditions($request);
        $sum = 0;
        foreach ($result as $product){
            $sum += ($product->price * $product->basket_count);
        }
        $record = new Order();
        if($request->hasFile('receipt') && $request->file('receipt')->isValid()) {//no problems uploading the file
            // image file
            $name =  Auth::id().'_'.date("Y-m-d-h-i-s") . '.' . $request->file('receipt')->extension();
            $request->receipt->storeAs('receipt_images',$name);
            $record->receipt_image = $name;
        }else{
            return back()->with('message', __('file is not uploaded ,Pls try another file or contact the admin '));
        }
        $record->sum_price_pros  = $sum;
        $record->post_price = $product->post_price;
        $record->deliver_place = auth()->user()->address.' '.__('title.postal_code') .' : '.auth()->user()->postal_code ;
        $record->final_price = $product->post_price + $sum;
        $record->save();
        foreach ($result as $product){
            Basket::SetOrder($product['basket_id'],$record->id);
        }
        $record->shopper_name = auth()->user()->name;
        $user =  User::find($product->user_id);
        $user->email = 'momeneh.jafari@gmail.com';
        Notification::send($user, new OrderCreated($record,App::getLocale() ));//sending notifications

        return redirect()->route('order.index')->with('message', __('messages.order_created'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function receipt($file_name){
        $order = Order::select('id')->where('receipt_image','=',$file_name)->firstOrFail();
        if(!isset($order->id)) abort(404);

        $or = Order::select('id')->where('receipt_image','=',$file_name)->with('Items.Products.Owner')->first()->toArray();
        $order->seller = collect($or['items'][0]['products']['owner']);
        $order->shopper_id = $or['items'][0]['users_id'];
        $this->authorize('ShowFile',$order);
        $storagePath = storage_path('app\receipt_images\\' . $file_name );
        return response()->file($storagePath);
    }


}
