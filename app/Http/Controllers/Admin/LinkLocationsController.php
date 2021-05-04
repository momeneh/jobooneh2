<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Link_locations;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class LinkLocationsController extends Controller
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
        $result = Link_locations::orderBy('id','DESC');
        if($request->title) $result = $result->where('title','LIKE','%'.$request->title.'%');
        if($request->id) $result = $result->where('id','=',$request->id);

        $result->where('lang_id','=',Helper::GetLocaleNumber());

        $result = $result->paginate(10)->appends('title',$request->title)->appends('id',$request->id);
        return view('link_locations.index',['list'=> $result,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('link_locations.create');
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
            'title' => 'required|unique:link_locations|min:3|max:15',
        ]);

        $record = new Link_locations();
        $record->title = $request['title'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->save();
        return redirect()->route('link_locations.index')->with('message', __('messages.created'));

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
        $record = Link_locations::findOrFail($id);
        return view('link_locations.edit',compact('record'));
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
            'title' => ['required','min:3','max:15',Rule::unique('link_locations')->ignore($id)],
        ]);
        $record = Link_locations::findOrFail($id);
        $record->title = $request['title'];
        $record->save();
        return redirect()->route('link_locations.index')->with('message', __('messages.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Link_locations::findOrFail($id)->delete();
        return back()->with('message', __('messages.deleted'));
    }


}
