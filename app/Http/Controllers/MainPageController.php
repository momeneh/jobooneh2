<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Categories;
use App\Models\Link;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductsImages;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MainPageController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {

        $slider = Link::select('title','link','image','description')->orderBy('id','ASC')->where('is_active','=',1)->where('lang_id','=',Helper::GetLocaleNumber())->get();
        $about_us = Page::select('id','title','body')->where('id','=', Helper::GetLocaleNumber())->get();//id page about = id_lang

        $category_pros = Categories::CategoriesProductCount();

        $new_products = Product::NewProducts();
        $most_visited_products = Product::MostVisitedProducts();

        $testimontal = Product::GetGoodSellers();

        return view('mainPage',compact('slider','about_us','category_pros','new_products','most_visited_products','testimontal'));
    }

    public function subscribe(Request $request){
        $this->validate($request,[
            'mail' =>'required|email|unique:subscribers',
        ]);

        $obj = new Subscriber();
        $obj->mail = $request['mail'];
        $obj->lang_id = Helper::GetLocaleNumber();
        $obj->save();

        return response()->json(['success' => true,'msg'=>__('thank you for subscribing.We would send any news to your mail ')],200);

    }
}
