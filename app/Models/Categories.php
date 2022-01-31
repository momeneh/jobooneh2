<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    use HasFactory;


    public function parent()
    {
        return $this->hasOne(self::class,'id','parent_id');
    }

    public function parents()
    {
        return $this->belongsTo('App\Models\Categories', 'parent_id');
    }

    public function getParentsNames($b = []) {
        if($this->parents) {
            $b[] = ['title'=>$this->title,'id'=>$this->id];
            return $this->parents->getParentsNames($b);
        } else {
            $b[] = ['title'=>$this->title,'id'=>$this->id];
            return $b;
        }
    }

    public static  function UserProductListCategories(){
        return  DB::table('categories AS a')
            ->select('a.id','a.title')
            ->join('products As p',function ($join){
                $join->on('a.id', '=', 'p.categories_id')
                    ->where('p.user_id', Auth::id())
                    ->where('a.lang_id',Helper::GetLocaleNumber());
            } )
            ->groupBy('a.id','a.title')
            ->get();
    }

    public static function CategoriesProductCount($limit=4){
        return DB::table('categories AS cat')
            ->select(DB::raw('cat.id,cat.icon,cat.title,count(distinct p.id) as count_pro'))
            ->join('products AS p',function ($join){
                $join->on('cat.id', '=', 'p.categories_id')
                    ->where('p.confirmed', 1)
                    ->where('cat.lang_id',Helper::GetLocaleNumber())
                    ->where('p.lang_id',Helper::GetLocaleNumber())
                    ->where('cat.is_active',1);
            } )
            ->orderBy('count_pro', 'DESC')
            ->limit($limit)
            ->groupBy('cat.id','cat.icon','cat.title')
            ->get();
    }
}
