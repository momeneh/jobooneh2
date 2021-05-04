<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class MenuController extends Controller
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
        $menus = Menu::orderBy('id','DESC');
        if($request->title) $menus = $menus->where('title','LIKE','%'.$request->title.'%');
        if($request->id) $menus = $menus->where('id','=',$request->id);

        $menus->where('lang_id','=',$this->GetLocaleNumber());

        $menus = $menus->paginate(10)->appends('title',$request->title)->appends('id',$request->id);
        return view('menu.index',compact('menus','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $menus = Menu::orderBy('id','DESC')->where('lang_id','=',$this->GetLocaleNumber())->get();
        return view('menu.create',compact('menus'));

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
            'title' => 'required|unique:menus|min:3|max:15',
            'link' => 'required',
            'priority' => 'numeric'
        ]);

        $menu = new menu();
        $menu->title = $request['title'];
        $menu->link = $request['link'];
        $menu->is_active = empty($request['is_active']) ? 0 : 1;
        $menu->parent_id = empty($request['parent_id']) ? NULL : $request['parent_id'] ;
        $menu->priority = $request['priority'] ;
        $menu->lang_id = $this->GetLocaleNumber();
        $menu->save();
        return redirect()->route('menu.index')->with('message', __('messages.created'));

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
        $menus = Menu::orderBy('id','DESC')->where('lang_id','=',$this->GetLocaleNumber())->where('id','!=',$id)->get();
        $menu = Menu::findOrFail($id);
        return view('menu.edit',compact('menu','menus'));
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
            'title' => ['required','min:3','max:15',Rule::unique('menus')->ignore($id)],
            'link' => 'required',
            'priority' => 'numeric'
        ]);
        $menu = Menu::findOrFail($id);
        $menu->title = $request['title'];
        $menu->link = $request['link'];
        $menu->is_active = empty($request['is_active']) ? 0 : 1;
        $menu->parent_id = empty($request['parent_id']) ? NULL : $request['parent_id'] ;
        $menu->priority = $request['priority'];
        $menu->save();
        return redirect()->route('menu.index')->with('message', __('messages.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
        return back()->with('message', __('messages.deleted'));
    }

    private function GetLocaleNumber(){

        if(App::getLocale() == 'fa') return 1 ;
        else  return  2 ;


    }
}
