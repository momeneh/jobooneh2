<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function __cunstruct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $result = Page::select('id','title',DB::raw("substr(`body`, 1, 50) as body") )->orderBy('id','DESC');
        if($request->title) $result = $result->where('title','LIKE','%'.$request->title.'%');
        if($request->id) $result = $result->where('id','=',$request->id);

        $result->where('lang_id','=',Helper::GetLocaleNumber());

        $result = $result->paginate(10)->appends('title',$request->title)->appends('id',$request->id);
        return view('page.index',['list'=> $result,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title' => 'required|unique:pages|min:3|max:50',
            'body' => 'required'
        ]);

        $record = new Page();
        $record->title = $request['title'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->body = $request['body'];
        $record->is_active = $request['is_active'];
        $record->save();

        return redirect()->route('page.index')->with('message', __('messages.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $record = page::findOrFail($id);
        return view('page.edit',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => ['required','min:3','max:50',Rule::unique('pages')->ignore($id)],
            'body' => 'required',
        ]);
        $record = page::findOrFail($id);
        $record->title = $request['title'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->body = $request['body'];
        $record->is_active = $request['is_active'];
        $record->save();

        return redirect()->route('page.index')->with('message', __('messages.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        page::findOrFail($id)->delete();
        return back()->with('message', __('messages.deleted'));
    }
}
