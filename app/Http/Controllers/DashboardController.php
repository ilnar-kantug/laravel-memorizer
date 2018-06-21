<?php

namespace App\Http\Controllers;

use App\UseCases\DashboardService;

class DashboardController extends Controller
{
    public $service;

    public function __construct(DashboardService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function show()
    {
        $user = $this->service->getUsersInfo();
        return view('dashboard', compact('user'));
    }
}
