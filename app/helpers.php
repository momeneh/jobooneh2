<?php
use Illuminate\Support\Facades\DB;

if(!function_exists('ESql')){
    function ESql(){
        DB::enableQueryLog();
    }
}
if(!function_exists('DSql')){
    function DSql($dump = 0){
        if($dump == 1 ) dd(DB::getQueryLog());
        return DB::getQueryLog();
    }
}
if(!function_exists('PersianNo')){
    function PersianNo($number){
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
}

if(!function_exists('StringToDate')){
    function StringToDate($string) {
        if(app()->getLocale() == 'fa') {
            $date = \Morilog\Jalali\Jalalian::fromFormat('Y-m-d', $string);
            $date = $date->toCarbon()->toDateTimeString();
        }else  $date = date('Y-m-d ',strtotime($string));
        return $date;
    }
}
if(!function_exists('MakeTree')) {
    function MakeTree($elements)
    {
        $parents = [];$append_array=[];
        foreach ($elements as $element){
            $parents[] = $element['id'];
        }
        foreach ($elements as $element){
            if(!in_array($element['parent_id'],$parents) && !empty($element['parent_id']))
                $append_array[] = $element;
        }
        $tree_array = ArrayToTree($elements);
        return array_merge($tree_array,$append_array);
    }
}

//parent_id in fields
if(!function_exists('ArrayToTree')){
    function ArrayToTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = ArrayToTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

}

if(!function_exists('MyPublic_path')){
    function MyPublic_path($path){
        if(str_contains(public_path(),'vhosts'))
        //server main
          return "/var/www/vhosts/jobooneh.ir/public/".$path;
        else
            return public_path($path);
    }
}

if(!function_exists('GetArrayfields')){
    function GetArrayfields($arr,$f,$separator){
        return implode($separator,\Illuminate\Support\Arr::pluck($arr,$f));
    }
}
