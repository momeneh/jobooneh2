<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param User $model
     * @return View
     */

    public function dashboard(){
        return view('users.dashboard');
    }

    public function autocomplete(Request $request){
        if ($request->ajax()) {

            $results=[];
            $result = User::orderBy('name','ASC')
                ->where('name', 'LIKE', '%'.$request->term.'%')->orWhere('email', 'LIKE', '%'.$request->term.'%')
                ->get();

            foreach ($result as $r)
            {
                $results[] = [ 'id' => $r->id, 'value' => $r->name.' : '.$r->email ];
            }

            return response()->json($results,200);
        }
    }
}
