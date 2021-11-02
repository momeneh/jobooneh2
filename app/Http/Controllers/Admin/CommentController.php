<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __cunstruct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $result = Comment::select('comments.*','p.id as p_id','p.title')->orderBy('comments.id','DESC')
        ->join('products As p',function ($join){
                $join->on('p.id', '=', 'comments.products_id')
                    ->where('p.lang_id',Helper::GetLocaleNumber());
            } );
        if($request->product_title) $result = $result->where('p.title','LIKE','%'.$request->product_title.'%');
        if($request->name) $result = $result->where('name','LIKE','%'.$request->name.'%');
        if($request->email) $result = $result->where('email','LIKE','%'.$request->email.'%');
        if($request->date_from)  $result = $result->where('comments.created_at','>=',StringToDate($request->date_from));
        if($request->date_to)   $result = $result->where('comments.created_at','<=',StringToDate($request->date_to));

        $result = $result->paginate(10);
        return view('comment.index',['list'=> $result,'request'=>$request]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Comment::findOrFail($id);
        $record->load('product');
        return view('comment.show',compact('record'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record =  Comment::findOrFail($id);

        $record->delete();
        return back()->with('message', __('messages.deleted'));
    }



}
