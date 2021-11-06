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
            ->orderBy('id','DESC')
            ->where('confirmed','1')
            ->where('lang_id','=',Helper::GetLocaleNumber())
            ->where('categories_id','=',$id)
//            ->whereHas('images', function ( $query)  {
//                $query->whereNotNull('image');
//            })
            ->with('images')
            ->cursorPaginate(12);
    }


    public static function GetProductsByOwnerId($id){
        return self::orderBy('visited_count','DESC')
            ->orderBy('id','DESC')
            ->where('confirmed','1')
            ->where('lang_id','=',Helper::GetLocaleNumber())
            ->where('user_id','=',$id)
            ->with('images')
            ->cursorPaginate(6);
    }

    private static function GetProductsSearchPart($request,$q){
        return $q->where('p.confirmed','1')
            ->where('p.lang_id','=',Helper::GetLocaleNumber())
            ->where('c.lang_id','=',Helper::GetLocaleNumber())
            ->join('categories As c', 'c.id', '=', 'p.categories_id')
            ->where(function ($q) use ($request ){
                $q->where('p.title' ,'LIKE','%'.$request->search_key.'%')
                    ->orWhere('p.description','LIKE','%'.$request->search_key.'%')
                    ->orWhere('c.title','LIKE','%'.$request->search_key.'%')
                ;
            });
    }

    public static function GetProductsSearch($request){
        $result = self::from('products AS p')
            ->select('p.*','c.title as category')
            ->orderBy('visited_count','DESC')
            ->orderBy('p.id','DESC');
        $result = self::GetProductsSearchPart($request,$result);

        if(!empty($request->cat_id)) $result = $result->where('c.id','=',$request->cat_id);
        if(!empty($request->owner_id)) $result = $result->where('p.user_id','=',$request->owner_id);

        $result = $result
            ->with('images')
            ->cursorPaginate(12);

        return $result;
    }

    public static function GetCategoriesSearch($request){
        $result = self::from('products AS p')
                    ->select('c.id','c.title','c.parent_id') ;

        $result = self::GetProductsSearchPart($request,$result);

        $result = $result->groupBy('c.id')->get()   ;
        return $result;
    }

    public static function GetOwnersSearch($request){
        $result = self::from('products AS p')
            ->select('u.id','u.name')
            ->join('users As u', 'u.id', '=', 'p.user_id');

        $result = self::GetProductsSearchPart($request,$result);

        $result = $result->groupBy('u.id')->get();
        return $result;
    }



}
