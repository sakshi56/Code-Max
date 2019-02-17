<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class MentorController extends Controller
{
    //
    public function mentorcard(){
        if(Session::get('username')!='')
            {
                Log::info(session('username'). " View Dashboard page");
                $data=DB::table('mem_cat')->get();
               
                return view('mentorcard',compact('data'));
            }
        else
            {
                Log::error('User name not found');
                return redirect('/')->with('status',"Please login First");
            }
    }
    public function mem_cat(Request $request){
       
             //   Log::info(session('username'). " Ajax member call");
             try{
                $data=DB::table('mentors')->where('mem_cat_id',$request->id)->get();
               
                return json_encode($data);
             }catch(\Exception $e){
                return json_encode($e->getMessage());
             }
              
    }
    public function req_mentor(Request $request){
        if(Session::get('username')!='')
        {
             try{
                 return $request;
                 $to_insert=array("start_date"=>$request->start_date,
                 "end_date"=>$request->end_date,
                 "status"=>"REQUESTED",
                 "strtup_id"=>Session::get('strt_up_id'),
                "mntr_id"=>$request->men_id,
                "created_at"=>now(),
                "updated_at"=>now()
                );
                $insert=DB::table('mntr_strtup')->insert($to_insert);
               
                if ($insert) {
                    return redirect()->back()->with('alert-success', 'Mentor is requested to connect successfully');
                } else {
                    return redirect()->back()->with('alert-danger', 'Mentor is not requested to connect successfully');
                }
             }catch(\Exception $e){
                return json_encode($e->getMessage());
             }
            }
            else
                {
                    Log::error('User name not found');
                    return redirect('/')->with('status',"Please login First");
                }

    }

}
