<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param User $model
     * @return View
     */
    public function __cunstruct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $result = User::select('id','name','email','created_at','mobile_no','job_title' )->orderBy('id','DESC');
        if($request->name) $result = $result->where('name','LIKE','%'.$request->name.'%');
        if($request->id) $result = $result->where('id','=',$request->id);
        if($request->email) $result = $result->where('email','LIKE',$request->email);
        if(trim($request->verified) == 2) $result = $result->whereNull('email_verified_at');
        if(trim($request->verified) == 1) $result = $result->whereNotNull('email_verified_at');

        $result = $result->paginate(10);
        return view('users.index', ['list' => $result,'request'=>$request]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $record = User::findOrFail($id);
        return view('users.edit',compact('record'));
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
            'name' => ['required','min:3','max:50'],
            'image' =>'nullable|image|mimes:jpeg,png,jpg|max:8192|dimensions:max_width=800,max_height=800'
        ];
        $uplaod_need = true;
        if(empty($request['image']) && !empty($request['image_name'])){
            $request['image'] = $request['image_name'];
            $uplaod_need = false;
            unset($rules['image']);
        }
        $this->validate($request,$rules);
        $record = User::findOrFail($id);
        $record->name = $request['name'];
        $record->address = $request['address'];
        $record->job_title = $request['title'];
        $record->description = $request['description'];
        $record->g_plus_address = $request['gplus'];
        $record->insta_address = $request['insta'];
        $record->facebook_address = $request['facebook'];
        $record->save();

        if($uplaod_need)
            if($request->hasFile('image') && $request->file('image')->isValid()) {//no problems uploading the file
                // image file
                $name =  $record->id . '.' . $request->file('image')->extension();
//                $request->file('image')->move(storage_path('profile_images'), $name);
                $request->image->storeAs('profile_images',$name);
                $record->image = $name;
                $record->save();
            }
        return redirect()->route('user.index')->with('message', __('messages.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('message', __('messages.deleted'));
    }

}
