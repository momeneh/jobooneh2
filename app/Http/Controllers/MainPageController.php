<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Categories;
use App\Models\Link;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductsImages;
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
}
