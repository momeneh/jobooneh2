<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class MessageComposer
{
     protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $viewView::composer
     * @return void
     */
    public function compose(View $view)
    {
        $navbar = strpos($this->request->route()->getPrefix() , 'admin')>0 ? ['admin' => 1] : ['page' => __('messages'), 'pageSlug' => 'message'];
        $prefix = strpos($this->request->route()->getPrefix() , 'admin')>0 ? 'admin.' : '';
        $view->with('navbar', $navbar);
        $view->with('prefix', $prefix);
    }
}
