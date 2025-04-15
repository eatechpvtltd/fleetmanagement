<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        // return 1;
        return view('Dashboard.Group');
    }
}
