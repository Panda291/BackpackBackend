<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaticNeedRequest;
use App\Http\Requests\UpdateStaticNeedRequest;
use App\Models\StaticNeed;

class StaticNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreStaticNeedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaticNeedRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaticNeed  $staticNeed
     * @return \Illuminate\Http\Response
     */
    public function show(StaticNeed $staticNeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaticNeed  $staticNeed
     * @return \Illuminate\Http\Response
     */
    public function edit(StaticNeed $staticNeed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStaticNeedRequest  $request
     * @param  \App\Models\StaticNeed  $staticNeed
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaticNeedRequest $request, StaticNeed $staticNeed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaticNeed  $staticNeed
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaticNeed $staticNeed)
    {
        //
    }
}
