<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{


    function dashboard(Request $request)
    {
        return view("dashboard");
    }

}
