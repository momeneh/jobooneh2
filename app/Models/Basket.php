<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $fillable=[
        'created_at',
        'updated_at',
        'products_id',
        'users_id',
        'count'
    ];

    public function Products(){
        return self::hasOne(Product::class,'id','products_id');
    }

    public static function CheckBasket($id_pro,$select='*'){
        return self::select($select)->where('products_id','=',$id_pro)->where('users_id','=',auth()->id())->whereNull('orders_id')->first();
    }

    public static function SetOrder($id,$order_id){
        return self::where('id','=',$id)->update(['orders_id'=>$order_id]);
    }



}
