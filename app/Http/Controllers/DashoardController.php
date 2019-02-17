<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DashoardController extends Controller
{
    
   
    public function index(){
        if(Session::get('username')!='')
            {
                Log::info(session('username'). " View Dashboard page");
                if(Session::get('strt_up_id')<1){
                    return view('dashboard');
                }else{
                    $task_data=DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->latest()->limit(10)->get();
                    $no_comp=DB::table('complaints')->where('strtup_id',Session::get('strt_up_id'))->count();
                    $no_event=DB::table('events')->count();
                    $total_task=DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->whereNotIn('status',['COMPLETED'])->count();
                   
                    $total_task2=DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->count();
                   
                   
                    $day_task = DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->whereDate('created_at',date("Y-m-d") )->count();
                    $yesterday_task=DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->whereDate('created_at',date('d.m.Y',strtotime("-1 days")) )->count();
                    $month_task = DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->whereMonth('created_at',date("m") )->count();
                    $year_task = DB::table('strtup_task')->where('strtup_id',Session::get('strt_up_id'))->whereYear('created_at',date("Y") )->count();

                    return view('dashboard',compact('total_task2','yesterday_task','month_task','year_task','task_data','no_comp','total_task','no_event','day_task'));
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
