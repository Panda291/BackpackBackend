<?php

namespace App\Http\Controllers;

use App\Models\StaticNeed;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
        if($request->filled('date')) {
            return Response(DB::table('static_needs')->whereDate('needed_on', $request->get('date')->get()));
        } else return Response(StaticNeed::all());
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

        return Response(StaticNeed::create($attributes));
    }

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
        ]);

        return Response($staticNeed->update($attributes));
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
