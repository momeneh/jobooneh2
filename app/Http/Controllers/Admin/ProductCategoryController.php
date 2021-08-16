<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
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
        $result = Categories::orderBy('id','DESC')->with('parent');
        if($request->title) $result = $result->where('title','LIKE','%'.$request->title.'%');
        if($request->id) $result = $result->where('id','=',$request->id);
        if(trim($request->active) == 2) $result = $result->where('is_active','=',0);
        if(trim($request->active) == 1) $result = $result->where('is_active','=',1);
        if($request->parent_id) $result = $result->where('parent_id','=',$request->parent_id);

        $result->where('lang_id','=',Helper::GetLocaleNumber());

        $result = $result->paginate(10);
        $parents = $this->GetParents();
        return view('categories.index',['list'=> $result,'request'=>$request,'parents'=>$parents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $parents = Categories::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        return view('categories.create',['parents'=>$parents]);
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
            'title' => 'required|unique:categories|min:3|max:15',
        ]);

        $record = new Categories();
        $record->title = $request['title'];
        $record->is_active = empty($request['is_active']) ? 0 : 1;
        $record->parent_id = empty($request['parent_id']) ? NULL : $request['parent_id'] ;
        $record->lang_id = Helper::GetLocaleNumber();
        $record->save();
        return redirect()->route('product_category.index')->with('message', __('messages.created'));

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
        $parents = Categories::orderBy('id','DESC')->where('lang_id','=',Helper::GetLocaleNumber())->get();
        $record = Categories::findOrFail($id);
        return view('categories.edit',compact('record','parents'));
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
            'title' => ['required','min:3','max:15',Rule::unique('categories')->ignore($id)],
        ]);
        $record = Categories::findOrFail($id);
        $record->title = $request['title'];
        $record->is_active = empty($request['is_active']) ? 0 : 1;
        $record->parent_id = empty($request['parent_id']) ? NULL : $request['parent_id'] ;
        $record->save();
        return redirect()->route('product_category.index')->with('message', __('messages.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Categories::findOrFail($id)->delete();
        return back()->with('message', __('messages.deleted'));
    }

    private function GetParents(){
        return DB::table('categories AS a')
            ->whereExists(function($query)
            {
                $query->select(DB::raw(1))
                    ->from('categories AS b')
                    ->whereRaw('b.parent_id = a.id');
            })
            ->get();
    }

}
