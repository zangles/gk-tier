<?php

namespace App\Http\Controllers;

use App\Pilot;
use App\pilotsDress;
use App\Raid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PilotController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $pilots = Pilot::all();
        $raids = Raid::all();

        return view('home', compact('pilots','raids'));
    }

    public function create()
    {
        $raids = Raid::all();

        return view('pilot.create', compact('raids'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:pilots',
        ]);

        $pilot = new Pilot();
        $pilot->id = $request->input('id');
        $pilot->name = $request->input('name');
        $pilot->type = $request->input('pilotType');

        $raids = Raid::all();

        foreach ($raids as $raid) {
            $pilot->raid()->attach($raid->id, ['tier' => $request->input('raid_'.$raid->id) ] );
        }

        $dressesName = $request->input('dressname');
        foreach ($dressesName as $dressName) {
            if($dressName != ""){
                $dress = new pilotsDress();
                $dress->name = $dressName;
                $pilot->dress()->save($dress);
            }
        }

        $pilot->save();

        return redirect()->route('pilot.index');
    }

    public function edit($id)
    {
        $pilot = Pilot::findOrFail($id);
        $raids = Raid::all();

        return view('pilot.edit', compact('pilot', 'raids'));
    }

    public function update(Request $request)
    {
        $pilot = Pilot::findOrFail($request->input('old_id'));

        $pilot->id = $request->input('id');
        $pilot->name = $request->input('name');
        $pilot->type = $request->input('pilotType');

        $raids = Raid::all();

        foreach ($raids as $raid) {
            DB::table('pilot_raid')
                ->where('raid_id', $raid->id)
                ->where('pilot_id', $request->input('old_id'))
                ->update(
                    array(
                        'tier' => $request->input('raid_'.$raid->id),
                        'pilot_id' => $request->input('id')
                    )
                );
        }

        $pilot->dress()->delete();
        $dressesName = $request->input('dressname');
        foreach ($dressesName as $dressName) {
            if($dressName != ""){
                $dress = new pilotsDress();
                $dress->name = $dressName;
                $pilot->dress()->save($dress);
            }
        }

        $pilot->save();

        return redirect()->route('pilot.index');

    }

    public function destroy(Request $request ,$id)
    {
        $pilot = Pilot::findOrFail($id);
        $pilot->delete();

        return redirect()->route('pilot.index');

    }
}
