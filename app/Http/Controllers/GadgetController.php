<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class GadgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $attributes = $request->validate([
            'in_backpack' => 'boolean',
            'id' => Rule::exists('gadgets', 'id'),
        ]);

        $filters = Gadget::query();

        if (array_key_exists('in_backpack', $attributes)) {
            $filters->where('in_backpack', $attributes['in_backpack']);
        }
        if (array_key_exists('gadget_id', $attributes)) {
            $filters->where('id', $attributes['id']);
        }

        return Response($filters->get());

        return Response(Gadget::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(): Response
    {
        $attributes = Request()->validate([
            'name' => ['required', 'unique:gadgets'],
        ]);
        return Response(Gadget::create($attributes));
    }

    /**
     * Display the specified resource.
     *
     * @param Gadget $gadget
     * @return Response
     */
    public function show(Gadget $gadget): Response
    {
        return Response($gadget);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Gadget $gadget
     * @return Response
     */
    public function update(Gadget $gadget): Response
    {
        $attributes = Request()->validate([
            'name' => ['required', 'unique:gadgets'],
        ]);
        return Response($gadget->update($attributes));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Gadget $gadget
     * @return Response
     */
    public function destroy(Gadget $gadget): Response
    {
        return Response($gadget->delete());
    }
}
