<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('Dashboard.index');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
}
