<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class StartupController extends Controller
{
    //
    public function strt_report(){
        if(Session::get('username')!='')
        {
            Log::info(session('username'). " View Dashboard page");
            
            $data1 = DB::table('startups')->where('status', 'ACCEPTED')->get();
            $data2 = DB::table('startups')->where('status', 'PENDING')->get();
           
            return view('startup_reports',compact('data1','data2'));
        }
    else
        {
             return redirect('/')->with('status',"Please login First");
        }
    }
    public function acceptStrp(Request $request){
        //start up status will changed when application accepted 
        //return $request;
        for($i=0;$i<sizeof($request->strt_id);$i++){

            $status = $request->status[$i];
            $strtup_id = $request->strt_id[$i];
            try {
            $update=DB::table('startups')->where('id',$strtup_id)->update(['status'=>$status,'updated_at' => now()]);
            }catch (\Exception $e) {
                return redirect()->back()->with('alert-danger', 'Error - ' . $e->getMessage());

            }
            return redirect()->back()->with('alert-success', 'Status Changed Successfully');
        }
    }
}
