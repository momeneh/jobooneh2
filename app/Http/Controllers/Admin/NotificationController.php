<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController;
use App\Models\Product;
use App\Notifications\AdminNotifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function __cunstruct(){
        $this->middleware('auth:admin');
    }

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

    public function notify_user(Request $request){
        $this->validate($request,[
            'desc' => 'required|min:3',
           'id_product' =>'required|numeric'
        ]);
        $record = Product::findOrFail($request['id_product']);
        $user = $record->Owner()->get();
        Notification::send($user, new AdminNotifyUser($record,Auth::user(),$request['desc']));

        //creat message because it is more simple for users to work with (see read at or reply to each other )
        $message = new MessageController();
        $request['receiver_id'] = 'user_'.$user[0]->id;
        $request['subject'] = __('messages.admin_notify').__(' about product ').$request['id_product'];
        $request['body'] = $request['desc'];
        $message->send_notify = false;
        $message->redirect = false;
        $message->store($request);

        return response()->json(['success' => true],200);
    }
}
