<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function comments()
    {
        return $this->hasMany(Comment::class,'products_id','id');
    }

    public static function NewProducts(){
        return self::orderBy('id','DESC')
            ->where('confirmed','1')
            ->where('lang_id','=',Helper::GetLocaleNumber())
            ->whereHas('images', function ( $query)  {
                 $query->whereNotNull('image');
             })
            ->with('images')
            ->limit('3')
            ->get();
    }

    public static function MostVisitedProducts(){
        return self::orderBy('visited_count','DESC')
            ->where('confirmed','1')
            ->where('lang_id','=',Helper::GetLocaleNumber())
            ->whereHas('images', function ( $query)  {
                $query->whereNotNull('image');
            })
            ->with('images')
            ->limit('6')
            ->get();

    }

    public static function GetGoodSellers(){
        return self::orderBy('count_visited','DESC')
            ->selectRaw('user_id,max(visited_count) as count_visited   ')
            ->where('confirmed','1')
            ->where('lang_id','=',Helper::GetLocaleNumber())
            ->whereHas('Owner', function ( $query)  {
                $query->whereNotNull('description');
                $query->whereNotNull('image');
            })
            ->with('owner')
            ->groupBy('user_id')
            ->limit('3')
            ->get();

    }

    public static function GetProductsByCatId($id){
        return self::orderBy('visited_count','DESC')
            ->where('confirmed','1')
            ->where('lang_id','=',Helper::GetLocaleNumber())
            ->where('categories_id','=',$id)
//            ->whereHas('images', function ( $query)  {
//                $query->whereNotNull('image');
//            })
            ->with('images')
            ->cursorPaginate(12);
    }



}
