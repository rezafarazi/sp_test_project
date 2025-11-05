<?php

namespace App\Http\Controllers;

use App\Models\users_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    //Get login page
    function login(Request $request)
    {
        if(Auth::check()){
            return redirect("/Dashboard");
        }

        return view('login');
    }


    //Get Check login
    function logindone(Request $request)
    {
        if(Auth::check()){
            return redirect("/Dashboard");
        }

        //Get user data from data base
        $userdata = users_tbl::where('username',$request->username)->where('password',hash('sha256',$request->password.'|10203151006016'))->first();

        //Get check user exist
        if($userdata != null){

            //Get auth submit in system
            Auth::login($userdata);
            return redirect("/Dashboard");

        }else{
            return view('login');
        }
    }


}
