<?php

namespace App\Http\Controllers;

use App\Guides;
use Illuminate\Http\Request;

class GuidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guide = Guides::findOrFail(1);
        $title = $guide->title;
        return view('guides.view', compact('guide', 'title'));

//        dd($guide->pilots()->get()[0]->ooparts()->get()[0]->oopart()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guides  $guides
     * @return \Illuminate\Http\Response
     */
    public function show(Guides $guides)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guides  $guides
     * @return \Illuminate\Http\Response
     */
    public function edit(Guides $guides)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guides  $guides
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guides $guides)
    {
        //
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
