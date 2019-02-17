<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    public function getEvent()
    {
        //EventData
        $eventName = DB::select('select evt_name');
        $organizerName = DB::table('startups')->select('name')->get()->where('org_startup_id', '');
        $part_Name = DB::table('startups')->select('name')->get()->where('prt_strtup_id', '');

        return view('event', compact('data','organizerName','getEvent'));


    }
}

