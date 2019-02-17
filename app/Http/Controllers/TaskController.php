<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{

    public function open_index()
    {

        if (Session::get('username') != '') {
            Log::info(session('username') . " Open page");

            $data = DB::table('strtup_task')->where('status', 'OPEN')->orWhere('status', 'JUST OPEN')->orWhere('status', 'IN PROGRESS')->orWhere('status', 'ALMOST COMPLETED')->get();

            return view('open_task', compact('data'));
        } else {
            Log::error('User name not found');
            return redirect('/')->with('status', "Please login First");
        }
    }
    public function new_task_index()
    {

        if (Session::get('username') != '') {
            Log::info(session('username') . " Open page - new task");

            return view('new_task');
        } else {
            Log::error('User name not found');
            return redirect('/')->with('status', "Please login First");
        }
    }
    public function completed_task_index()
    {

        if (Session::get('username') != '') {
            Log::info(session('username') . " Open page Completed Task");

            $data = DB::table('strtup_task')->where('status', 'COMPLETED')->get();

            return view('completed_task', compact('data'));
        } else {
            Log::error('User name not found');
            return redirect('/')->with('status', "Please login First");
        }
    }
    public function open_submit(Request $request)
    {

        if (Session::get('username') != '') {
            //return $request;
            for ($i = 0; $i < sizeof($request->tk_id); $i++) {
                $task_id = $request->tk_id[$i];
                $status = $request->status[$i];

                try {
                    $update = DB::table('strtup_task')->where('id', $task_id)->update(['status' => $status, 'updated_at' => now()]);

                } catch (\Exception $e) {
                    return redirect()->back()->with('alert-danger', 'Error - ' . $e->getMessage());

                }

            }
            return redirect()->back()->with('alert-success', 'Status Changed Successfully');
            ///return view('open_task', compact('data'));
        } else {
            Log::error('User name not found');
            return redirect('/')->with('status', "Please login First");
        }
    }
    public function new_task(Request $request)
    {

        if (Session::get('username') != '') {

            try {
                $strtup_id = Session::get('strt_up_id');
                $insert = DB::table('strtup_task')->insert(['task_name' => $request->title, 'strtup_id' => $strtup_id, 'status' => 'JUST OPEN', 'created_at'=>now(), 'updated_at'=>now()]);
                if ($insert) {
                    return redirect('open_task')->with('alert-success', 'Status Changed Successfully');
                } else {
                    return redirect()->back()->with('alert-danger', 'Not inserted');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('alert-danger', 'Error - ' . $e->getMessage());
                Log::error('User name not found');
            }
        } else {

            return redirect('/')->with('status', "Please login First");
        }
    }

}
