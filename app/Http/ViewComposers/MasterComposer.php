<?php

namespace App\Http\ViewComposers;

use App\Helpers\Helper;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\View;
use App\Repositories\UserRepository;

class MasterComposer
{
    /**
     * The user repository implementation.
     *
     */
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $viewView::composer
     * @return void
     */
    public function compose(View $view)
    {
        $menus = Menu::select('title','link')->orderBy('priority','ASC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        $footer_desc = Page::select('id','title','body')->where('title','=', __('title.footer_desc'))->get();
        $view->with('main_menus', $menus->toArray());
        $view->with('footer_desc', $footer_desc->toArray());
    }
}
