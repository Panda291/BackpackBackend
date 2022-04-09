<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function switch(Gadget $gadget)
    {
        $gadget->in_backpack = !$gadget->in_backpack;
        $gadget->save();
        return Response($gadget);
    }
}
