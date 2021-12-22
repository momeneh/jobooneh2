<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{


    /**
     * Display notifications page
     *
     * @return View
     */
    public function notifications()
    {
        return view('users.notifications',['notifications'=>auth()->user()->Notifications]);
    }

    public function destroyNotifications($id){
        auth()->user()->notifications()->where('id', $id)->delete();
    }

    public function destroyAllNotifications(){
        auth()->user()->notifications()->delete();
        return back()->with('message', __('messages.deleted'));
    }



    public function show($id){
        $record = Page::findOrfail($id);
        return view('page.show',compact('record'));
    }


}
