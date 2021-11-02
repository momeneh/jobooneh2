<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Morilog\Jalali\Jalalian;

class ContactController extends Controller
{
    public function contact_form(){
        return view('page.contact_form');
    }

    public function contact_us(Request $request)
    {
        $this->validate($request,[
            'email'=> 'required|email',
            'message'=>'required|min:5',
            'phone'=>'nullable|numeric',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);
        $record = new Contact();
        $record->name = $request['name'];
        $record->email = $request['email'];
        $record->phone = $request['phone'];
        $record->message = $request['message'];
        $record->save();

        Notification::send( Admin::all(), new \App\Notifications\contactNotifyAdmin(App::getLocale() ,$record));//sending mail about message
        return redirect()->back()->with('message', __('messages.message_sent'));
    }

    public function index(Request $request)
    {
        $result = Contact::orderBy('id','DESC');
        if($request->name) $result = $result->where('name','LIKE','%'.$request->name.'%');
        if($request->email) $result = $result->where('email','LIKE','%'.$request->email.'%');
        if($request->date_from) $result = $result->where('created_at','>=',StringToDate($request->date_from));
        if($request->date_to) $result = $result->where('created_at','<=',StringToDate($request->date_to));

        $result = $result->paginate(10);
        return view('contact.index',['list'=> $result,'request'=>$request]);
    }

    public function show($id)
    {
        $record = Contact::findOrfail($id);

        return view('contact.show',compact('record'));
    }
}
