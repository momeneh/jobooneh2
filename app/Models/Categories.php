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

    public static  function UserProductListCategories(){
        return  DB::table('categories AS a')
            ->select('a.id','a.title')
            ->join('products As p',function ($join){
                $join->on('a.id', '=', 'p.categories_id')
                    ->where('p.user_id', Auth::id())
                    ->where('a.lang_id',Helper::GetLocaleNumber());
            } )
            ->groupBy('a.id')
            ->get();
    }
}
