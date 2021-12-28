<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    public function Items(){
        return $this->hasMany(Basket::class,'orders_id','id');
    }

    public function seller(){
        return $this->with('Items.Products.Owner');
    }

    public function shopper(){
        return $this->hasOne(User::class,'id','shopper_id');
    }

    public function seller2(){
        return $this->hasOne(User::class,'id','seller_id');
    }

    public static function SetCountProduct($order_id,$add = false){
        if(!$add) $part = 'p.count = p.count - b.count';
        else $part = 'p.count = p.count + b.count';

        //log count
        DB::statement('update products p
            join baskets b on (b.products_id = p.id)
            join orders o ON (b.orders_id = o.id AND o.id='.$order_id.')
            set '.$part);

    }

    public static function GetProsOrder($order_id){
        return self::select('p.id','p.count as p_count','b.count as b_count')
            ->from('products AS p')
            ->join('baskets AS b','b.products_id', '=', 'p.id')
            ->join ('orders AS o', function ($join )use ($order_id) {
                $join->on('b.orders_id', '=', 'o.id')
                    ->where('o.id','=',$order_id);
            })->get();
    }



}
