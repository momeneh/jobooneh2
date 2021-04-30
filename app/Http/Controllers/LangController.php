<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function lang($locale)
    {
        if (! in_array($locale, ['en', 'fa'])) {
            $locale = 'fa';
        }
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

}
