<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display icons page
     *
     * @return View
     */
    public function icons()
    {
        return view('pages.icons');
    }

    /**
     * Display maps page
     *
     * @return View
     */
    public function maps()
    {
        return view('pages.maps');
    }

    /**
     * Display tables page
     *
     * @return View
     */
    public function tables()
    {
        return view('pages.tables');
    }

    /**
     * Display notifications page
     *
     * @return View
     */
    public function notifications()
    {
//        return view('pages.notifications');
        return view('users.notifications',['notifications'=>auth()->user()->Notifications]);
    }

    public function destroyNotifications($id){
        auth()->user()->notifications()->where('id', $id)->delete();
    }

    public function destroyAllNotifications(){
        auth()->user()->notifications()->delete();
        return back()->with('message', __('messages.deleted'));
    }

    /**
     * Display rtl page
     *
     * @return View
     */
    public function rtl()
    {
        return view('pages.rtl');
    }

    /**
     * Display typography page
     *
     * @return View
     */
    public function typography()
    {
        return view('pages.typography');
    }


    public function show($id){
        $record = Page::findOrfail($id);
        return view('page.show',compact('record'));
    }


}
