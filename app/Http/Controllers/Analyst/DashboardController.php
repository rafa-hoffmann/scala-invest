<?php

namespace App\Http\Controllers\Analyst;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('analyst.dashboard');
    }
}
