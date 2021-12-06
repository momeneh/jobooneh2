<?php

namespace App\Listeners;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class BasketTempSave
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //------------------when user logged in all cookie basket move to db_basket
        $pros = [];
       if(Auth::guard('web')->check()){
           foreach($_COOKIE as $name => $value) {
               if (!is_numeric($value)) continue;
               if (strpos($name, 'tmp_basket_pro_id') === false) continue;

               $id = substr($name, 18, strlen($name));
               $list[$id] = $value;
               $pros[] = $id;
               Cookie::queue(Cookie::forget($name));
           }
           $result = Product::GetBasketProducts($pros);
           foreach ($result as $product){
               $cookie_count = $list[$product->id];
               $basket = Basket::CheckBasket($product->id,'count');
               if(empty($basket->count)  && $cookie_count >0 ){
                   $b = new Basket();
                   $b->products_id = $product->id;
                   $b->users_id = auth()->id();
                   $b->count = $cookie_count;
                   $b->save();
               }
           }
       }

    }
}
