<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('system.dashboard');
    }

    public function company(){
        return view('system.components.branch.index');
    }

    public function company_create(){
        return view('system.components.branch.create');
    }

}
