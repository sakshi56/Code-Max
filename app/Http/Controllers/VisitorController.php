<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class VisitorController extends Controller
{
    //show list of all visitors
    public function showVisitor()
    {
        $id = Session::get('id');
       // Log::info(session('visitor_table') . " Open start up Accepted page");
        $data = DB::table('visitor_table')->distinct()->get();
        
            //yaha view ka nam daal dena kaha bhejna hai
            return view('visitor', compact('data'));
       
    }
    public function addVisitor(Request $request){
        //return $request;
        try {
           // $id = Session::get('id');
           $insert = DB::table('visitor_table')->insert(['visitor_name' => $request->visitor_name,
             'visitor_contact' => $request->contact, 'visitor_address' => $request->visitor_address, 
            'purpose'=>$request->purpose,'visit_cmpny'=>$request->visit_cmpny, 'created_at'=>now(), 'updated_at'=>now()]);
            if ($insert) {
                return redirect()->back()->with('alert-success', 'visitor added Successfully');
            } else {
                return redirect()->back()->with('alert-danger', 'Not inserted');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('alert-danger', 'Error - ' . $e->getMessage());
            Log::error('not found');
        }
    

}
    public function new_visitor_index(Request $request){
        if(Session::get('username')!='')
        {
            Log::info(session('username'). " View open site page");
            
            
            return view('new_visitor');
        }
    else
        {
             return redirect('/')->with('status',"Please login First");
        }
    

}
}
