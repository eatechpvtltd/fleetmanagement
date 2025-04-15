<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allTripReport(Request $request){
       return view('report');
    }
}
