<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Link_locations;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LinkController extends Controller
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
//        DB::enableQueryLog();
        $result = Link::with('link_locations')->orderBy('id','DESC');
        if($request->title) $result = $result->where('title','LIKE','%'.$request->title.'%');
        if($request->id) $result = $result->where('id','=',$request->id);
        if($request->location_id) $result = $result->where('location_id','=',$request->location_id);

        $result->where('lang_id','=',Helper::GetLocaleNumber());

        $result = $result->paginate(10)->appends('title',$request->title)->appends('id',$request->id)->appends('location_id',$request->location_id);

        $locations = Link_locations::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();

//        dd($result->all());
//        dd(DB::getQueryLog());
        return view('link.index',['list'=> $result,'request'=>$request,'locations'=>$locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $locations = Link_locations::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        return view('link.create',['locations'=>$locations]);
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
            'title' => 'required|unique:links|min:3|max:50',
            'link' => 'required',
            'location_id' => 'required|numeric',
            'image' =>'required|image|mimes:jpeg,png,jpg|max:8192|dimensions:max_width=1920,max_height=796'
        ]);

        $record = new Link();
        $record->title = $request['title'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->link = $request['link'];
        $record->description = $request['description'];
        $record->location_id = $request['location_id'];
        $record->save();

        if($request->hasFile('image') && $request->file('image')->isValid()) {//no problems uploading the file
            // image file
            $name = 'link-' . $record->id . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('link_images'), $name);
            $record->image = $name;
            $record->save();
        }

        return redirect()->route('link.index')->with('message', __('messages.created'));

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
        $locations = Link_locations::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        $record = Link::findOrFail($id);
        return view('link.edit',compact('record','locations'));
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
        $rules=[
            'title' => ['required','min:3','max:50',Rule::unique('links')->ignore($id)],
            'link' => 'required',
            'location_id' => 'required|numeric',
            'image' =>'required|image|mimes:jpeg,png,jpg|max:8192|dimensions:max_width=1920,max_height=796'
        ];
        $uplaod_need = true;
        if(empty($request['image']) && !empty($request['image_name'])){
            $request['image'] = $request['image_name'];
            $uplaod_need = false;
            unset($rules['image']);
        }
        $this->validate($request,$rules);
        $record = Link::findOrFail($id);
        $record->title = $request['title'];
        $record->lang_id = Helper::GetLocaleNumber();
        $record->link = $request['link'];
        $record->description = $request['description'];
        $record->location_id = $request['location_id'];
        $record->save();

        if($uplaod_need)
        if($request->hasFile('image') && $request->file('image')->isValid()) {//no problems uploading the file
            // image file
            $name = 'link-' . $record->id . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('link_images'), $name);
            $record->image = $name;
            $record->save();
        }
        return redirect()->route('link.index')->with('message', __('messages.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Link::findOrFail($id)->delete();
        return back()->with('message', __('messages.deleted'));
    }
}
