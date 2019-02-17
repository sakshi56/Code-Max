<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DashoardController extends Controller
{
    
    //
    public function index(){
        if(Session::get('username')!='')
            {
                Log::info(session('username'). " View Dashboard page");
                if(Session::get('strt_up_id')<1){
                    return view('dashboard');
                }else{
                    $task_data=DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->latest()->limit(10)->get();


                    return view('dashboard',compact('task_data'));
                }
                
            }
        else
            {
                Log::error('User name not found');
                return redirect('/')->with('status',"Please login First");
            }
    }
    public function profile(){
        if(Session::get('username')!='')
            {
                Log::info(session('username'). " View Dashboard page");
                 return view('profile');
            }
        else
            {
                Log::error('User name not found');
                return redirect('/')->with('status',"Please login First");
            }
    }
}
