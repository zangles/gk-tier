<?php

namespace App\Http\Controllers;

use App\Guides;
use App\Pilot;
use App\PilotsGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guides = Guides::all();
        $title = 'Guides';

        return view('guides.list', compact('guides', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pilots = Pilot::all();
        $title = 'Create Guide';
        return view('guides.create', compact('pilots','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $guide = new Guides();
        $guide->title = $request->input('title');
        $guide->user_id = Auth::user()->id;
        $guide->content = $request->input('content');
        $guide->save();

        for($i = 1; $i <= 9; $i++) {
            $pilotId = $request->input('pilot_'.$i);
            if (!is_null($pilotId)) {
                $pilot = new PilotsGuide();
                $pilot->pilot_id = $pilotId;
                $pilot->position = $i;
                $pilot->wave = 1;

                $guide->pilots()->save($pilot);
            }
        }

        return redirect()->route('guides.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guides  $guide
     * @return \Illuminate\Http\Response
     */
    public function show(Guides $guide)
    {
        $title = $guide->title;

        $positions = $this->getPilotPositions($guide);

        return view('guides.view', compact('guide', 'title', 'positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guides  $guides
     * @return \Illuminate\Http\Response
     */
    public function edit($guideId)
    {
        $guide = Guides::findOrfail($guideId);

        $pilots = Pilot::all();
        $title = $guide->title;
        $positions = $this->getPilotPositions($guide);

        $cantSelected = $guide->pilots()->count();
        return view('guides.edit', compact('guide', 'title', 'positions', 'pilots','cantSelected'));
    }

    private function getPilotPositions($guide)
    {
        $positions = [];
        for ($i=1; $i<=9 ; $i++){
            $pilot = $guide->pilots()->where('position',$i)->get();
            if ($pilot->count() == 0) {
                $positions[$i] = '';
            } else {
                $positions[$i] = $pilot->first()->pilot();
            }
        }

        return $positions;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guides  $guides
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guides $guide)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);


        $guide->title = $request->input('title');
        $guide->user_id = Auth::user()->id;
        $guide->content = $request->input('content');
        $guide->save();

        for($i = 1; $i <= 9; $i++) {
            $pilotId = $request->input('pilot_'.$i);
            if (!is_null($pilotId)) {
                $pilot = new PilotsGuide();
                $pilot->pilot_id = $pilotId;
                $pilot->position = $i;
                $pilot->wave = 1;

                $guide->pilots()->save($pilot);
            }
        }

        return redirect()->route('guides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guides  $guides
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guides $guides)
    {
        //
    }
}
