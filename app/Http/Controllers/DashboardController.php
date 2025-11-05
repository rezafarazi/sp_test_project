<?php

namespace App\Http\Controllers;

use App\Models\reports_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    function dashboard(Request $request)
    {
        $user = Auth::user();

        if($user->role == "USER"){
            return view("dashboard");
        } else {
            $list = [];

            if($user->role == "ADMIN1"){
                $list = reports_tbl::where('status', '0')->get();
            } else if($user->role == "ADMIN2"){
                $list = reports_tbl::where('status', '1')->get();
            }

            return view("admindashboard")->with('list', $list);
        }
    }
}
