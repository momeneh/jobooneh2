<?php
namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Helper
{
    static  function toPersianNum($number)
    {
        $number = str_replace("1","۱",$number);
        $number = str_replace("2","۲",$number);
        $number = str_replace("3","۳",$number);
        $number = str_replace("4","۴",$number);
        $number = str_replace("5","۵",$number);
        $number = str_replace("6","۶",$number);
        $number = str_replace("7","۷",$number);
        $number = str_replace("8","۸",$number);
        $number = str_replace("9","۹",$number);
        $number = str_replace("0","۰",$number);
        return $number;
    }

    static function GetLocaleNumber(){

        if(App::getLocale() == 'fa') return 1 ;
        else  return  2 ;
    }

    static function BindGuardModel(){
       switch ( Auth::getDefaultDriver()){
           case 'web' :return 'App\Models\User';break;
           default :return 'App\Models\Admin';
       }
    }



}

