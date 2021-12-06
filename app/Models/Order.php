<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function Items(){
        return $this->hasMany(Basket::class,'orders_id','id');
    }

    public function seller(){
        return $this->with('Items.Products.Owner');
    }


}
