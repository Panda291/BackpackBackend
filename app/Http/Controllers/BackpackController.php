<?php

namespace App\Http\Controllers;

use App\Models\StaticNeed;
use App\Models\Gadget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackpackController extends Controller
{
    public function setContents(Request $request)
    {
        $removedGadgets = Gadget::all()->where('in_backpack', true);
        foreach ($removedGadgets as $gadget) {
            $gadget->in_backpack = !$gadget->in_backpack;
            $gadget->save();
        }
        $attributes = $request->validate([
            'RFIDs' => 'required',
        ]);
        $addedGadgets = Gadget::all()->whereIn('RFID', json_decode($attributes['RFIDs']));
        $newGadgets = array_diff(json_decode($attributes['RFIDs']), $addedGadgets->map(function ($e) {
            return $e->RFID;
        })->all());

        foreach ($newGadgets as $gadgetRFID) {
            $gadget = Gadget::create([
                'name' => $gadgetRFID,
                'icon' => 0,
            ]);
            $gadget->RFID = $gadgetRFID;
            $gadget->in_backpack = true;
            $gadget->save();
        }

        foreach ($addedGadgets as $gadget) {
            $gadget->in_backpack = true;
            $gadget->save();
        }
        return Response('', 202);
    }

    public function allPresent()
    {
        $dynamicNeeds = DB::table('dynamic_needs')->whereDate('needed_on', Carbon::today())->get('gadget_id')->all();
        $dynamicNeeds = array_map(function ($e) {
            return $e->gadget_id;
        }, $dynamicNeeds);
        $staticNeeds = StaticNeed::all()->where('day_of_week', Carbon::today()->dayOfWeek)
            ->map(function ($e) {
                return $e->gadget_id;
            })->all();
        $needs = array_merge($dynamicNeeds, $staticNeeds);

        $missingGadgets = Gadget::all()->where('in_backpack', false)->whereIn('id', $needs);
        if (empty($missingGadgets->all())) {
            return Response('', 204);
        } else {
            return Response(array_values($missingGadgets->toArray()));
        }
    }

    public function needed(Request $request)
    {
        $attributes = $request->validate([
            'date' => 'date',
        ]);

        if (array_key_exists('date', $attributes)) {
            $dynamicNeeds = DB::table('dynamic_needs')->whereDate('needed_on', $attributes['date'])
                ->get('gadget_id')->all();
        } else {
            $dynamicNeeds = DB::table('dynamic_needs')->whereDate('needed_on', Carbon::today())
                ->get('gadget_id')->all();
        }
        $dynamicNeeds = array_map(function ($e) {
            return $e->gadget_id;
        }, $dynamicNeeds);

        if (array_key_exists('date', $attributes)) {
            $date = new Carbon($attributes['date']);
            $staticNeeds = StaticNeed::all()->where('day_of_week', $date->dayOfWeek);
        } else {
            $staticNeeds = StaticNeed::all()->where('day_of_week', Carbon::today()->dayOfWeek);
        }
        $dynamicIds = $staticNeeds
            ->map(function ($e) {
                return $e->gadget_id;
            })->all();
        $needs = array_merge($dynamicNeeds, $dynamicIds);

        $neededGadgets = Gadget::all()->whereIn('id', $needs);

        return Response(array_values($neededGadgets->toArray()));
    }
}
