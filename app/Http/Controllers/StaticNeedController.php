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
            'needed_on' => 'date',
            'gadget_id' => Rule::exists('gadgets', 'id'),
        ]);

        $filters = StaticNeed::query();

        if (array_key_exists('needed_on', $attributes)) {
            $filters->whereDate('needed_on', $attributes['needed_on']);
        }
        if (array_key_exists('gadget_id', $attributes)) {
            $filters->where('gadget_id', $attributes['gadget_id']);
        }

        return Response($filters->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(): Response
    {
        $attributes = Request()->validate([
            'gadget_id' => ['required', Rule::exists('gadgets', 'id')],
            'needed_on' => 'required|date'
        ]);

        if (StaticNeed::query()->where('gadget_id', $attributes['gadget_id'])
            ->where('needed_on', $attributes['needed_on'])->get()->isEmpty()) {
            return Response(StaticNeed::create($attributes));
        } else {
            return Response('A dynamic need for that gadget already exists for that day', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param StaticNeed $staticNeed
     * @return Response
     */
    public function show(StaticNeed $staticNeed): Response
    {
        return Response($staticNeed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param StaticNeed $staticNeed
     * @return Response
     */
    public function update(Request $request, StaticNeed $staticNeed): Response
    {
        $attributes = $request->validate([
            'gadget_id' => Rule::exists('gadgets', 'id'),
            'needed_on' => 'date',
        ]);

        $filters = StaticNeed::query();

        if (array_key_exists('needed_on', $attributes)) {
            $filters->whereDate('needed_on', $attributes['needed_on']);
        } else {
            $filters->whereDate('needed_on', $staticNeed->needed_on);
        }

        if (array_key_exists('gadget_id', $attributes)) {
            $filters->where('gadget_id', $attributes['gadget_id']);
        } else {
            $filters->where('gadget_id', $staticNeed->gadget_id);
        }

        if (empty($filters->get()->all())) {
            return Response($staticNeed->update($attributes));
        } else {
            return Response('A dynamic need for that gadget already exists for that day', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StaticNeed $staticNeed
     * @return Response
     */
    public function destroy(StaticNeed $staticNeed): Response
    {
        return Response($staticNeed->delete());
    }
}
