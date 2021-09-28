<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Message;
use App\Models\MessageAttachments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;

class MessageController extends Controller
{
    public $send_notify = true;
    public $redirect = true;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        Message::factory(10)->create();
        $result = Message::orderBy('id','DESC')
                ->where('receiver_id','=',Auth::user()->id)
                ->where('receiver_type','=',Helper::BindGuardModel());

        if($request->subject) $result = $result->where('subject','LIKE','%'.$request->subject.'%');
        if($request->sender) {
            $result = $result->whereHas('Sender', function ( $query) use ($request) {
                $query->where('name', 'like', '%'.$request->sender.'%');
            });
        }
        if($request->date_from) {
            $date_from = Jalalian::fromFormat('Y-m-d',  $request->date_from );
            $date_from =  $date_from->toCarbon()->toDateTimeString() ;
            $result = $result->where('created_at','>=',$date_from);
        }
        if($request->date_to) {
            $date_to = Jalalian::fromFormat('Y-m-d',  $request->date_to );
            $date_to =  $date_to->toCarbon()->toDateTimeString() ;
            $result = $result->where('created_at','<=',$date_to);
        }

//        $result->where('lang_id','=',Helper::GetLocaleNumber()); // user get all messges from all languages
        $result = $result->paginate(10);

        return view('message.index',['list'=> $result,'request'=>$request]);
    }

    public function SentMessages(Request $request){
        $result = Message::orderBy('id','DESC')->withTrashed()
            ->where('sender_id','=',Auth::user()->id)
            ->where('sender_type','=',Helper::BindGuardModel());

        if($request->subject) $result = $result->where('subject','LIKE','%'.$request->subject.'%');
        if($request->receiver) {
            $result = $result->whereHas('receiver', function ( $query) use ($request) {
                $query->where('name', 'like', '%'.$request->receiver.'%');
            });
        }
        if($request->date_from) {
            $date_from = Jalalian::fromFormat('Y-m-d',  $request->date_from );
            $date_from =  $date_from->toCarbon()->toDateTimeString() ;
            $result = $result->where('created_at','>=',$date_from);
        }
        if($request->date_to) {
            $date_to = Jalalian::fromFormat('Y-m-d',  $request->date_to );
            $date_to =  $date_to->toCarbon()->toDateTimeString() ;
            $result = $result->where('created_at','<=',$date_to);
        }

//        $result->where('lang_id','=',Helper::GetLocaleNumber()); // user get all messges from all languages
        $result = $result->paginate(10);

        return view('message.sent',['list'=> $result,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Message $message)
    {
        $message->load('receiver');
        return view('message.create',['message'=>$message,'receiver'=>'']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = 'App\Models\User';
        if(!empty($request['receiver_id'])) {
            $ar = explode('_',$request['receiver_id']);
            $request['receiver_id'] = $ar[1];
            $request['receiver_type'] = $ar[0];
            if($request['receiver_type'] == 'admin') $model = 'App\Models\Admin';
        }

        $m= __('messages.receiver_required');
        $this->validate($request,[
            'receiver_id' =>'required|numeric|exists:'.$model.',id',
            'subject' => 'required|min:3',
        ],['receiver_id.required'=>$m,'receiver_id.numeric'=>$m,'receiver_id.exists'=>$m]);

        $record = new Message();
        $record->subject = $request['subject'];
        $record->sender_type = Helper::BindGuardModel();
        $record->sender_id = Auth()->user()->id;
        $record->receiver_id = $request['receiver_id'];
        $record->receiver_type = $model;
        $record->body = $request['body'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->save();

        $images = $request->input('image', []);
        for ($i=0; $i < count($images); $i++) {
            $im = new MessageAttachments(['file'=>$images[$i]]);
            $request->session()->forget($images[$i]);//after user sent a message file names should be removed from session
            $record->attachments()->save($im);
        }

        if ($this->send_notify)
            Notification::send( $record->receiver()->get(), new \App\Notifications\Message(App::getLocale() ,$record));//sending mail about message

        if($this->redirect)
            return redirect()->route('message.index')->with('message', __('messages.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::withTrashed()->findOrFail($id);
        $this->authorize('view',$message )    ;
        $message->load('attachments','sender');

        $type_user = Helper::BindGuardModel();
        if  ($type_user === $message->receiver_type && auth()->user()->id == $message->receiver_id) $this->SetReaded($message);


        return view('message.show',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $message =  Message::findOrFail($id);
        $this->authorize('update',$message )    ;
        $this->SetReaded($message);
        return back()->with('message', __('messages.updated'));

    }

    private function SetReaded($message){
        $message->read_at = Carbon::now()->toDateTimeString();
        $message->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message =  Message::findOrFail($id);
        $this->authorize('delete',$message )    ;

        $message->delete();
        return back()->with('message', __('messages.deleted'));

    }

    public function autocomplete(Request $request){
        if ($request->ajax()) {

            $results=[];
            $users = DB::table('users')->selectRaw('CONCAT("user","_",id) as id ,name,email')->orderBy('name')
                ->where('name', 'LIKE', '%'.$request->term.'%')->orWhere('email', 'LIKE', '%'.$request->term.'%')
                ;
            $result = DB::table('admins')->selectRaw('CONCAT("admin","_",id) as id,name,email')->orderBy('name')
                ->where('name', 'LIKE', '%'.$request->term.'%')->orWhere('email', 'LIKE', '%'.$request->term.'%')
                ->union($users)
                ->get()
            ;
            foreach ($result as $r)
            {
                $results[] = [ 'id' => $r->id, 'value' => $r->name.' : '.$r->email ];
            }

            return response()->json($results,200);
        }
    }

    public function upload(Request $request){
        $i = preg_replace('/[^0-9]*/', '', array_keys($request->all())[0]);
        $var_name = 'uploadfile'.$i;
        $name =  md5(Auth::getDefaultDriver().'_'.Auth::id().'_'.date("Y-m-d-h-i-s"))  . '__' . $request->file($var_name)->getClientOriginalName();
        $file = new FileController('required|mimes:jpeg,png,jpg,pdf,xls,docx|max:8192','attachments/',$var_name,$name);
        return $file->UploadFile($request);
    }

    public function show_attachments($name_file){
        //1: if name file is in session so user has uploaded it recently
        if(empty(session($name_file))) {
            //2: find message of this file
            $attach = MessageAttachments::select('messages_id')->where('file', '=', $name_file)->get();
            if(!isset($attach->toarray()[0]['messages_id'])) abort(404);
            $message = Message::findOrFail($attach->toarray()[0]['messages_id']);
            //3: authorize for delete product
            $this->authorize('ShowFile', $message)   ;
        }
        return response()->download(storage_path('app\attachments\\'.$name_file));
    }

    public function remove(Request $request){
        $name_file = basename($request['file']);
        //1: the user can remove attachments that have uploaded recently
        if(empty(session($name_file))) {
                return response()->json([__('not found')],404);
        }
        $file = new FileController('required','attachments/','file','');
        return $file->RemoveFile($request);
    }

    public function ReplyMessages($id){
        $message =  Message::findOrFail($id);
        $this->authorize('reply',$message );
        $message->load('sender');
        $message->receiver = $message->sender;
        $receiver = $message->sender->name.'('.$message->sender->email.')';
        $message->receiver_id = strtolower(substr($message->sender_type,11,strlen($message->sender_type))).'_'.$message->sender_id;
        $message->subject = __('reply : ').$message->subject;
        if(app()->getLocale() == 'fa' ) $date = Helper::toPersianNum(CalendarUtils::strftime('Y-m-d H:i:s', strtotime($message->created_at)));
        else $date = $message->created_at;
            $message->body = "\r\n".'-------------'.__('title.on') ."\r\n". $date ."\r\n". $message->sender->name .' '. __('title.wrote')." : "."\r\n".$message->body;
        return view('message.create',['message'=>$message,'receiver'=>$receiver]);
    }


}
