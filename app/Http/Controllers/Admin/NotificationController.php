<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.notifications',['notifications'=>auth()->user()->Notifications]);
    }

    public function destroy($id){
        auth()->user()->notifications()->where('id', $id)->delete();
    }

    public function destroy_all(){
        auth()->user()->notifications()->delete();
        return back()->with('message', __('messages.deleted'));
    }
}
