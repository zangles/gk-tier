<?php

namespace App\Http\Controllers;

use App\Pilot;
use App\Raid;
use Illuminate\Http\Request;

class PilotController extends Controller
{
    public function index()
    {
        $pilots = Pilot::all();
        $raids = Raid::all();

        return view('welcome', compact('pilots','raids'));
    }
}
