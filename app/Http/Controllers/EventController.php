<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    public function getEvent()
    {
        //EventData
        $eventName = DB::select('evt_name','name' );

        return view('event', compact('data'));


        //StartUp name who is organizing
        $organizerName = DB::table('startups')->select('name')->get()->where('org_startup_id', '');

        return view('event', compact('organizerName'));

    //StartUp name who is Participating
        $part_Name = DB::table('startups')->select('name')->get()->where('prt_strtup_id', '');

        return view('event', compact('part_Name'));

    }
}

