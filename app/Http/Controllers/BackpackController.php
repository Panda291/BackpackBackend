<?php

namespace App\Http\Controllers;

use App\Models\DynamicNeed;
use App\Models\Gadget;
use App\Models\StaticNeed;
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
        foreach ($addedGadgets as $gadget) {
            $gadget->in_backpack = true;
            $gadget->save();
        }
        return Response($addedGadgets);
    }

    public function allPresent()
    {
        $staticNeeds = DB::table('static_needs')->whereDate('needed_on', Carbon::today())->get('gadget_id')->all();
        $staticNeeds = array_map(function ($e) {
            return $e->gadget_id;
        }, $staticNeeds);
        $dynamicNeeds = DynamicNeed::all()->where('day_of_week', Carbon::today()->dayOfWeek)
        ->map(function($e) { return $e->gadget_id; })->all();
        $needs = array_merge($staticNeeds, $dynamicNeeds);
        
        $missingGadgets = Gadget::all()->where('in_backpack', false)->whereIn('id', $needs);
        return Response($missingGadgets);
    }
}
