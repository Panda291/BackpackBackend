<?php

namespace App\Http\Controllers;

use App\Models\DynamicNeed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DynamicNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Response(DynamicNeed::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $attributes = $request->validate([
            'gadget_id' => ['required', Rule::exists('gadgets', 'id')],
            'day_of_week' => 'required|numeric|between:0,7'
        ]);

        return Response(DynamicNeed::create($attributes));
    }

    /**
     * Display the specified resource.
     *
     * @param DynamicNeed $dynamicNeed
     * @return Response
     */
    public function show(DynamicNeed $dynamicNeed): Response
    {
        return Response($dynamicNeed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DynamicNeed $dynamicNeed
     * @return Response
     */
    public function update(Request $request, DynamicNeed $dynamicNeed): Response
    {
        $attributes = $request->validate([
            'gadget_id' => Rule::exists('gadgets', 'id'),
            'day_of_week' => 'numeric|between:0,7'
        ]);

        return Response($dynamicNeed->update($attributes));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DynamicNeed $dynamicNeed
     * @return Response
     */
    public function destroy(DynamicNeed $dynamicNeed): Response
    {
        return Response($dynamicNeed->delete());
    }
}
