<?php

namespace App\Http\Controllers;

use App\Pilot;
use App\Raid;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function test()
    {
        return response()->stream(function () {
            var_dump('Hello World');
            flush();
            sleep(10);
            var_dump('Hello World');
            flush();
        }, 200);
    }

    public function list()
    {
        $pilots = Pilot::orderBy('name')->get();
        $raids = Raid::all();
        $title = 'Pilots';

        return view('pilot.list', compact('pilots','raids', 'title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        $pilots = Pilot::all();
//        $raids = Raid::all();
//
//        return view('home', compact('pilots','raids'));
//    }

    public function best($id)
    {
        $pilots = Pilot::all();
        $raids = Raid::all();
        $raidId = $id;

        $raid = Raid::findOrFail($raidId);

        $title = 'The best in '.$raid->name;

        return view('pilot.list', compact('pilots','raids','raidId', 'title'));
    }

    public function pilot($id)
    {
        $pilot = Pilot::findOrFail($id);
        $raids = Raid::all();

        $title = trans('gk.'.$pilot->name);

        return view('pilot.view', compact('pilot', 'raids', 'title'));
    }
}
