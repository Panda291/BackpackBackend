<?php

namespace App\Http\Controllers;

use App\Models\StaticNeed;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StaticNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $attributes = $request->validate([
            'day_of_week' => 'numeric|between:0,7',
            'gadget_id' => Rule::exists('gadgets', 'id'),
        ]);

        $filters = StaticNeed::query();

        if (array_key_exists('day_of_week', $attributes)) {
            $filters->where('day_of_week', $attributes['day_of_week']);
        }
        if (array_key_exists('gadget_id', $attributes)) {
            $filters->where('gadget_id', $attributes['gadget_id']);
        }

        return Response($filters->get());
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

        if (StaticNeed::all()->where('gadget_id', $attributes['gadget_id'])
            ->where('day_of_week', $attributes['day_of_week'])->isEmpty()) {
            return Response(StaticNeed::create($attributes));
        } else {
            return Response('A dynamic need for that gadget already exists for that day', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param StaticNeed $dynamicNeed
     * @return Response
     */
    public function show(StaticNeed $dynamicNeed): Response
    {
        return Response($dynamicNeed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param StaticNeed $dynamicNeed
     * @return Response
     */
    public function update(Request $request, StaticNeed $dynamicNeed): Response
    {
        $attributes = $request->validate([
            'gadget_id' => Rule::exists('gadgets', 'id'),
            'day_of_week' => 'numeric|between:0,6'
        ]);

        $filters = StaticNeed::query();

        if (array_key_exists('day_of_week', $attributes)) {
            $filters->where('day_of_week', $attributes['day_of_week']);
        } else {
            $filters->where('day_of_week', $dynamicNeed->day_of_week);
        }

        if (array_key_exists('gadget_id', $attributes)) {
            $filters->where('gadget_id', $attributes['gadget_id']);
        } else {
            $filters->where('gadget_id', $dynamicNeed->gadget_id);
        }

        if (empty($filters->get()->all())) {
            return Response($dynamicNeed->update($attributes));
        } else {
            return Response('A dynamic need for that gadget already exists for that day', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StaticNeed $dynamicNeed
     * @return Response
     */
    public function destroy(StaticNeed $dynamicNeed): Response
    {
        return Response($dynamicNeed->delete());
    }
}
