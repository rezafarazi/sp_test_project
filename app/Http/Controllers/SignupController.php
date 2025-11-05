<?php

namespace App\Http\Controllers;

use App\Models\users_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{

    function signup(Request $request){
        if(Auth::check()){
            return redirect("/Dashboard");
        }

        return view("/signup");
    }


    function signupdone(Request $request){

        if(Auth::check()){
            return redirect("/Dashboard");
        }

        // Validation
        $request->validate([
            'name' => 'required|string|min:2|max:50',
            'family' => 'required|string|min:2|max:50',
            'username' => 'required|string|min:3|max:50|unique:users_tbl,username',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|in:admin,user,manager',
        ]);

        //Get create new user
        $n_user = new users_tbl();
        $n_user->name = $request->name;
        $n_user->family = $request->family;
        $n_user->username = $request->username;
        $n_user->password = hash('sha256',$request->password.'|10203151006016');
        $n_user->start_datetime = date("Y-m-d H:i:s");
        $n_user->last_edit_datetime = date("Y-m-d H:i:s");
        $n_user->role = $request->type;
        $n_user->save();

        Auth::login($n_user);
        return redirect("/Dashboard");
    }

}
