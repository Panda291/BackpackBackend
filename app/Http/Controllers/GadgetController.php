<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaticGadgetRequest;
use App\Http\Requests\UpdateStaticGadgetRequest;
use App\Models\Gadget;
use http\Env\Request;

class GadgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response(Gadget::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = Request()->validate([
            'name' => 'required',
        ]);
        return Response(Gadget::create($attributes));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Gadget  $gadget
     * @return \Illuminate\Http\Response
     */
    public function update(Gadget $gadget)
    {
        $attributes = Request()->validate([
            'name' => 'required',
        ]);

        return Response($gadget->update($attributes));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gadget  $gadget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gadget $gadget)
    {
        return Response($gadget->delete());
    }
}
