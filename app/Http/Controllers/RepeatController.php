<?php

namespace App\Http\Controllers;

use App\Entity\Pack;
use App\UseCases\RepeatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RepeatController extends Controller
{
    public $service;

    public function __construct(RepeatService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Pack $pack)
    {
        if (!Gate::allows('show-pack', $pack)) {
            abort(403, 'You are not allowed!');
        }

        $pack = Pack::find($pack->id);

        return view('repeat', [
            'pack' => $pack,
            'routeToStart' => route('repeat.session', ['id'=>$pack->id])
        ]);
    }

    public function session($id)
    {
        if (!request()->ajax()) {
            abort(403, 'Only Ajax Requests!');
        }

        $returnResponce = $this->service->handleRequest($id);

        return response()->json(['success' => true, 'html'=>$returnResponce]);
    }
}
