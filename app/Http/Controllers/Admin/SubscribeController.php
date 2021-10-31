<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IncomesExport;
use App\Exports\NewsletterExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __cunstruct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $result = Newsletter::orderBy('id','DESC')
            ->with('InsertBy');
        if($request->subject) $result = $result->where('title','LIKE','%'.$request->subject.'%');
        if($request->creator){
            $result = $result->whereHas('InsertBy', function ( $query) use ($request) {
                $query->where('name', 'like', '%'.$request->creator.'%');
            });
        }
        if($request->date_from) {
            $date_from = Jalalian::fromFormat('Y-m-d',  $request->date_from );
            $date_from =  $date_from->toCarbon()->toDateTimeString() ;
            $result = $result->where('sent_at','>=',$date_from);
        }
        if($request->date_to) {
            $date_to = Jalalian::fromFormat('Y-m-d',  $request->date_to );
            $date_to =  $date_to->toCarbon()->toDateTimeString() ;
            $result = $result->where('sent_at','<=',$date_to);
        }

        $result->where('lang_id','=',Helper::GetLocaleNumber());

        $result = $result->paginate(10);

        return view('newsletter.index',['list'=> $result,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required|min:3|max:50',
            'body' => 'required',
        ]);

        $record = new Newsletter();
        $record->title = $request['subject'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->body = $request['body'];
        $record->admins_id = Auth()->id();
        $record->save();

        return redirect()->route('subscribe.index')->with('message', __('messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Newsletter::findOrFail($id);
        return view('newsletter.show',compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Newsletter::findOrFail($id);
        return view('newsletter.show',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'subject' => 'required|min:3|max:50',
            'body' => 'required',
        ]);

        $record = Newsletter::findOrFail($id);
//        dd(Gate::inspect('update',$record));
        $this->authorize('update',$record )    ;
        $record->title = $request['subject'];
        $record->body = $request['body'];
        $record->save();

        return redirect()->route('subscribe.index')->with('message', __('messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record =  Newsletter::findOrFail($id);
        $this->authorize('delete',$record )    ;

        $record->delete();
        return back()->with('message', __('messages.deleted'));
    }


   public function UploadFile(Request $request){
        $i = preg_replace('/[^0-9]*/', '', array_keys($request->all())[0]);
        $var_name = 'upload';
        $name =  Auth::id().'_'.date("Y-m-d-h-i-s")  . '.' . $request->file($var_name)->extension();
        $file = new FileController('required|image|mimes:jpeg,png,jpg|max:8192','newsletter_images/',$var_name,$name);
        return $file->UploadFile($request);
   }

   public function receivers($id){
        $record = Newsletter::findOrFail($id);
        $record->load('subscribers');
        if(App::getLocale() == 'fa')
            foreach ($record->subscribers as $s){
                $s->created_at2 = CalendarUtils::strftime('Y/m/d H:i:s', $s->created_at);
                $s->sent_at =    CalendarUtils::strftime('Y/m/d H:i:s', $s->sent_at) ;
                unset($s->created_at);
            }

       $filename = '\report_excels\newsletter_receivers_'.$id.'.xlsx';
       Excel::store(new NewsletterExport($record->subscribers),$filename);
       return response()->download(storage_path().'\app'.$filename );
   }

   public function send($id){
       $newsletter = Newsletter::findOrFail($id);
       $this->authorize('delete',$newsletter );

       $receivers = Subscriber::where('lang_id','=',Helper::GetLocaleNumber())->get();
       if(!empty($receivers))
           DB::transaction(function () use ($receivers,$newsletter) {
               $newsletter->sent_at = Carbon::now()->toDateTimeString();
               $newsletter->save();
               Notification::send( $receivers, new \App\Notifications\Newsletter(App::getLocale() ,$newsletter));
           });

       return back()->with('message', __('messages.newsletter_sent'));
   }
}
