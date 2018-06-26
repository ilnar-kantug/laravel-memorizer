<?php

namespace App\Http\Controllers;

use App\Entity\Pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RepeatController extends Controller
{
    public function start(Pack $pack)
    {
        if (!Gate::allows('show-pack', $pack)) {
            abort(403, 'You are not allowed!');
        }

        $pack = Pack::find($pack->id);

        return view('repeat', compact('pack'));
    }
}
