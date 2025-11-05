<?php

namespace App\Http\Controllers;

use App\Models\reports_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{

    function nreport(Request $request){

//        $request->validate([
//            'title' => 'required|string|max:255',
//            'text' => 'required|string',
//            'attach' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240'
//        ]);

        $n_report = new reports_tbl();
        $n_report->title = $request->title;
        $n_report->text = $request->text;

        if ($request->hasFile('attach')) {
            $file = $request->file('attach');

            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('reports', $fileName, 'public');
            $n_report->file_addres = $filePath;

            // $n_report->file_addres = $file->store('reports', 'public');
        } else {
            $n_report->file_addres = null;
        }

        $n_report->status = "0";
        $n_report->datetime = date("Y-m-d H:i:s");
        $n_report->save();

        return redirect()->back();

    }



    function CheckReport(Request $request){

        $user = Auth::user();

        if($user->role == "ADMIN1"){
            reports_tbl::where('id',$request->id)->update(["status"=>"1"]);
        } else if($user->role == "ADMIN2"){
            reports_tbl::where('id',$request->id)->update(["status"=>"2"]);
        }

        return redirect()->back();
    }

}
