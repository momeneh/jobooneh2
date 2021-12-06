<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $rules=[
            'name' => ['required','min:3','max:50'],
            'email' =>['required', 'string', 'email',Rule::unique('users')->ignore(auth()->user()->id)],
            'mobile' => ['nullable','numeric'],
            'image' =>'nullable|image|mimes:jpeg,png,jpg|max:8192|dimensions:max_width=800,max_height=800',
            'postal' => ['nullable','digits:10'],
            'card' => ['nullable','numeric']
      ];
        $uplaod_need = true;
        if(empty($request['image']) && !empty($request['image_name'])){
            $request['image'] = $request['image_name'];
            $uplaod_need = false;
            unset($rules['image']);
        }
        $this->validate($request,$rules);
        $record = auth()->user();
        $record->name = $request['name'];
        $record->email = $request['email'];
        $record->mobile_no = $request['mobile'];
        $record->address = $request['address'];
        $record->job_title = $request['title'];
        $record->description = $request['description'];
        $record->g_plus_address = $request['gplus'];
        $record->insta_address = $request['insta'];
        $record->facebook_address = $request['facebook'];
        $record->postal_code = $request['postal'];
        $record->post_price = $request['post_price'];
        $record->card_number = $request['card'];
        $record->card_owner = $request['card_owner'];
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
        return redirect()->route('profile.edit')->with('message', __('messages.updated'));
    }

    public function change_password(){
        return view('profile.change_password');
    }
    /**
     * Change the password
     *
     * @param PasswordRequest $request
     * @return RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
