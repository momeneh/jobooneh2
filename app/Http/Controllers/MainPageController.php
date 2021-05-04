<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Link;
use App\Models\Page;
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
        return view('welcome',compact('slider','about_us'));
    }
}
