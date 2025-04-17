<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    // Show all vehicles
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
        return view('Dashboard.Vehicle', compact('vehicles'));
    }

    // Add new vehicle
    // public function AddNEWVEHICLE(Request $request)
    // {
    //         $vehicle = new Vehicle();

    //         $vehicle->addvehicle = $request->input('addvehicle');
    //         $vehicle->adddriver = $request->input('adddriver');
    //         $vehicle->site = $request->input('site');
    //         $vehicle->group = $request->input('group');
    //         $vehicle->assignvalue = $request->input('assignvalue');

    //         $vehicle->save();

    //         return redirect()->back()->with('success', 'Vehicle added successfully!');
    //     
    // }
}