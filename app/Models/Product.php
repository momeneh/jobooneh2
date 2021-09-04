<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(ProductsImages::class,'products_id','id');
    }

    public function category(){
        return $this->hasOne(Categories::class,'id','categories_id');
    }

    public function Owner(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function lang(){
        return $this->belongsTo(Lang::class);
    }

}
