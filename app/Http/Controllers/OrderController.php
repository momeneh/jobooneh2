<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Basket;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderConfirmed;
use App\Notifications\OrderCreated;
use App\Notifications\OrderProblem;
use App\Notifications\OrderTrackingNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Basket::where('users_id','=',auth()->id())->orderBy('orders_id','desc')->whereNotNULL('orders_id')->with('Order','Image')->get();
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
        $record->seller_id = $product->user_id;
        $record->shopper_id = auth()->id();
        $record->lang_id = Helper::GetLocaleNumber();
        $record->save();
        foreach ($result as $product){
            Basket::SetOrder($product['basket_id'],$record->id);
        }
        $record->shopper_name = auth()->user()->name;
        $user =  User::find($product->user_id);
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
        $record = Order::findOrFail($id);
        $this->authorize('update',$record )    ;
        $record->load('shopper','seller2');
        return view('order_manage.edit',compact('record'));
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
        $record = Order::findOrFail($id);
        $this->authorize('update',$record )    ;
        $before_confirmed = $record->owner_confirmed;
        $before_tracking_number = $record->post_tracking_number;
        $record->owner_confirmed  = empty($request['confirmed']) ? 0 : 1;
        $record->post_tracking_number = $request['post_track'] ;

        $record->save();

        //confirming order
        if((empty($before_confirmed) || $before_confirmed == 0 ) && $record->owner_confirmed == 1  ){
            //minos stock pros
            $this->SetProsCount($record->id);

            // notify the shopper
            $user =  User::find($record->shopper_id);
            Notification::send($user, new OrderConfirmed($record,App::getLocale() ));//sending notifications
        }
        //before was confirmed but now is not
        else if((!empty($before_confirmed) && $before_confirmed == 1 ) && $record->owner_confirmed == 0  )
            $this->SetProsCount($record->id,true);

        if($before_tracking_number != $record->post_tracking_number) {
            if(empty($user)) $user =  User::find($record->shopper_id);
            Notification::send($user, new OrderTrackingNumber($record, App::getLocale()));//sending notifications
        }


        return redirect()->route('requested_orders')->with('message', __('messages.updated'));
    }

    private function SetProsCount($order_id,$add=false){
        $st = !$add ? ' mines ' : ' plus (turn back confirm) ';

        $pros = Order::GetProsOrder($order_id);
        if(!empty($pros))
            foreach ($pros as $product){
                Storage::append('product_count_logs/'.$product->id.'.txt', Carbon::now().': ----  count: '.$product->p_count. $st .$product->b_count. ' because of order : '.$order_id);
                if(!$add)
                    $count = $product->p_count - $product->b_count;
                else
                    $count = $product->p_count + $product->b_count;
                Product::SetCount($product->id,$count);
            }
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

    public function requested(Request $request){
        $this->authorize('listRequested' ,Order::class)    ;
        $orders = Order::orderBy('id','DESC')->with('seller2','shopper');
        if(Auth::getDefaultDriver() != 'admin')  $orders->where('seller_id','=',auth()->id());

        if(trim($request->owner_confirmed) == 2) $orders = $orders->where('owner_confirmed','=',0);
        if(trim($request->owner_confirmed) == 1) $orders = $orders->where('owner_confirmed','=',1);
        if($request->seller) {
            $orders = $orders->whereHas('seller2', function ( $query) use ($request) {
                $query->where('name', 'like', '%'.$request->seller.'%');
            });
        }
        if($request->shopper) {
            $orders = $orders->whereHas('shopper', function ( $query) use ($request) {
                $query->where('name', 'like', '%'.$request->seller.'%');
            });
        }
        if($request->date_from)  $orders = $orders->where('created_at','>=',StringToDate($request->date_from));
        if($request->date_to)   $orders = $orders->where('created_at','<=',StringToDate($request->date_to));

        $orders->where('lang_id','=',Helper::GetLocaleNumber());

        $list = $orders->paginate(10);
        return view('order_manage.index',compact('list','request'));

    }

    public function confirm($id){
        $order = Order::findOrFail($id);
        $this->authorize('update',$order )    ;
        if(!empty($order->owner_confirmed) && $order->owner_confirmed == 1)
           return redirect()->route('requested_orders')->with('message', __('messages.order_confirmed_before'));

        $order->owner_confirmed = 1;
        $order->save();

        //minos stock pros
        $this->SetProsCount($order->id);

        // notify the shopper
        $user =  User::find($order->shopper_id);
        Notification::send($user, new OrderConfirmed($order,App::getLocale() ));//sending notifications

        return redirect()->route('requested_orders')->with('message', __('messages.updated'));
    }

    public function problem($id){
        $order = Order::findOrFail($id);
        $this->authorize('update',$order )    ;
        if(!empty($order->owner_confirmed) && $order->owner_confirmed == 1)
            return redirect()->route('requested_orders')->with('message', __('messages.order_confirmed_before'));

        $result = Basket::where('orders_id','=',$id)->with('Image')->get();
        return view('order_manage.problem',['item'=> $order,'pros'=>$result]);
    }

    public function problem_desc(Request $request){
        $order = Order::findOrFail($request['order_id']);
        $this->authorize('update',$order )    ;
        if(!empty($order->owner_confirmed) && $order->owner_confirmed == 1)
            return redirect()->route('requested_orders')->with('message', __('messages.order_confirmed_before'));
        $user =  User::find($order->shopper_id);
        Notification::send($user, new OrderProblem($order,App::getLocale() ,$request['body']));//sending notifications

        //creat message because it is more simple for users to work with (see read at or reply to each other )
        $message = new MessageController();
        $message->send_notify = false;
        $message->store($request);
        return redirect()->route('message_sent')->with('message', __('messages.created'));

    }


}
