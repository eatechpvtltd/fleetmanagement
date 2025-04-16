<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function index(Request $request)
    // {
    //     try {
    //         $drivers = \App\Models\Driver::all();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Drivers retrieved successfully',
    //             'data' => $drivers
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to retrieve drivers: ' . $e->getMessage(),
    //             'data' => []
    //         ], 500);
    //     }
    // }
    public function login(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            // Attempt to generate JWT token
            if (!$token = Auth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Get the authenticated user
            $user = Auth::user();
            
            // Generate a random token and store it in remember_token
            $randomToken = bin2hex(random_bytes(32));
            $user->remember_token = $randomToken;
            $user->save();

            // Login the user into the Laravel Auth system
            Auth::login($user);

            return response()->json([
                'success' => true,
                'token' => $token,        
                'remember_token' => $randomToken,
                'user' => $user,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function  driver(){
        try {
            $drivers = \App\Models\Driver::all();
            return response()->json([
                'success' => true,
                'message' => 'Drivers retrieved successfully',
                'data' => $drivers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve drivers: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
    public function vehicleCount() {
        // Static data for vehicle status counts
        $vehicleCounts = [
            'running' => 12,
            'idle' => 8,
            'not_reachable' => 5,
            'all' => 25, // or you could do running + idle + not_reachable
        ];
    
        return response()->json([
            'success' => true,
            'data' => $vehicleCounts
        ]);
    }

    public function vehicle() {
        // return \App\Models\Vehicle::all();
        try {
            $sites = \App\Models\Vehicle::all();
            return response()->json([
                'success' => true,
                'message' => 'Vehicles retrieved successfully',
                'data' => $sites
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve sites: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
    public function site() {
        try {
            $sites = \App\Models\Site::all();
            return response()->json([
                'success' => true,
                'message' => 'Sites retrieved successfully',
                'data' => $sites
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve sites: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
    public function getTripSummary(Request $request)
    {
        // Static data mimicking the original dummyData structure
        $dummyData = [
            [
                "group" => "GT-BHUBANESWARI-PO",
                "vehicles" => [
                    [
                        "vehicleId" => "4150058701",
                        "vehicleName" => "OR-19-F-6477 MAY-25",
                        "trips" => [
                            [
                                "sn" => 1,
                                "startTime" => "2025-04-15 07:14",
                                "endTime" => "2025-04-15 07:16",
                                "siteName" => "pidha chak",
                                "duration" => "0 Days 0 Hours 2 Minutes"
                            ],
                            [
                                "sn" => 2,
                                "startTime" => "2025-04-15 07:17",
                                "endTime" => "2025-04-15 07:38",
                                "siteName" => "NO2 LOAD TRAFIC",
                                "duration" => "0 Days 0 Hours 21 Minutes"
                            ],
                            [
                                "sn" => 3,
                                "startTime" => "2025-04-15 07:40",
                                "endTime" => "2025-04-15 07:41",
                                "siteName" => "pidha chak",
                                "duration" => "0 Days 0 Hours 1 Minutes"
                            ]
                        ]
                    ],
                    [
                        "vehicleId" => "4150058702",
                        "vehicleName" => "OR-19-F-6478 MAY-25",
                        "trips" => [
                            [
                                "sn" => 1,
                                "startTime" => "2025-04-15 08:00",
                                "endTime" => "2025-04-15 08:10",
                                "siteName" => "biswal chak",
                                "duration" => "0 Days 0 Hours 10 Minutes"
                            ]
                        ]
                    ]
                ]
            ],
            [
                "group" => "GT-JHARSUGUDA-PO",
                "vehicles" => [
                    [
                        "vehicleId" => "4150058703",
                        "vehicleName" => "OR-20-G-1234 MAY-25",
                        "trips" => []
                    ]
                ]
            ]
        ];

        // Extract parameters from the request
        $group = $request->input('group');
        $vehicleId = $request->input('vehicle');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Find the selected group and vehicle
        $selectedGroup = collect($dummyData)->firstWhere('group', $group);
        $trips = [];
        $vehicleName = '';

        if ($selectedGroup) {
            $selectedVehicle = collect($selectedGroup['vehicles'])->firstWhere('vehicleId', $vehicleId);
            if ($selectedVehicle) {
                $vehicleName = $selectedVehicle['vehicleName'];
                $trips = $selectedVehicle['trips'];
            }
        }

        // Format the response
        $response = [
            'group' => $group,
            'vehicleId' => $vehicleId,
            'vehicleName' => $vehicleName,
            'data' => $trips
        ];

        return response()->json($response);
    }
}
