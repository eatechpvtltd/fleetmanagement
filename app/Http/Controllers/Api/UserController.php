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
    public function stateCount()
    {
       try {
        $stateVehicleCount = [
            ["Orissa" => 7],
        ];
            return response()->json([
                'success' => true,
                'message' => 'State Vehicle Counts retrieved successfully',
                'data' => $stateVehicleCount
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve State Vehicle Counts: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
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
    public function liveLocation()
    {
        try {
            $sites = [ 
                [
                    "id" => 1,
                    "vehicle_number" => "OD02CD3456",
                    "group_name" => "Delivery",
                    "timestamp" => "2025-04-15 11:00:00",
                    "nearest_site" => "Depot Cuttack",
                    "speed" => 40.5,
                    "vehicle_regd_date" => "2022-05-12",
                    "nearest_site_km" => 2.1,
                    "idle_time" => "00:15:42",
                    "is_idle" => false,
                    "latitude" => 20.4625,
                    "longitude" => 85.8828,
                    "location_name" => "Cuttack Station",
                    "address" => "Ring Road, CDA Area",
                    "city" => "Cuttack",
                    "state" => "Odisha",
                    "country" => "India",
                    "ignition" => true,
                    "movement" => true,
                    "driver_name" => "Rajeev Das",
                    "driver_mobile_number" => "9876543210",
                    "postal_code" => "753014"
                ],
                [
                    "id" => 2,
                    "vehicle_number" => "OD33XY1234",
                    "group_name" => "Logistics",
                    "timestamp" => "2025-04-15 10:45:00",
                    "nearest_site" => "Warehouse Bhubaneswar",
                    "speed" => 58.9,
                    "vehicle_regd_date" => "2023-03-08",
                    "nearest_site_km" => 4.5,
                    "idle_time" => "00:00:00",
                    "is_idle" => false,
                    "latitude" => 20.2961,
                    "longitude" => 85.8245,
                    "location_name" => "Bhubaneswar East",
                    "address" => "Patia, InfoCity Area",
                    "city" => "Bhubaneswar",
                    "state" => "Odisha",
                    "country" => "India",
                    "ignition" => true,
                    "movement" => true,
                    "driver_name" => "Suresh Nayak",
                    "driver_mobile_number" => "9876543211",
                    "postal_code" => "751024"
                ],
                [
                    "id" => 3,
                    "vehicle_number" => "OD05EF6789",
                    "group_name" => "Fleet Services",
                    "timestamp" => "2025-04-15 09:50:00",
                    "nearest_site" => "Rourkela Terminal",
                    "speed" => 0.0,
                    "vehicle_regd_date" => "2021-11-23",
                    "nearest_site_km" => 1.2,
                    "idle_time" => "01:03:12",
                    "is_idle" => true,
                    "latitude" => 22.2604,
                    "longitude" => 84.8536,
                    "location_name" => "Rourkela Yard",
                    "address" => "Uditnagar Sector 3",
                    "city" => "Rourkela",
                    "state" => "Odisha",
                    "country" => "India",
                    "ignition" => false,
                    "movement" => false,
                    "driver_name" => "Prakash Meher",
                    "driver_mobile_number" => "9876543212",
                    "postal_code" => "769012"
                ],
                [
                    "id" => 4,
                    "vehicle_number" => "OD17GH9876",
                    "group_name" => "Mining",
                    "timestamp" => "2025-04-15 11:20:00",
                    "nearest_site" => "Angul Base",
                    "speed" => 30.7,
                    "vehicle_regd_date" => "2020-09-30",
                    "nearest_site_km" => 3.0,
                    "idle_time" => "00:05:11",
                    "is_idle" => false,
                    "latitude" => 20.8383,
                    "longitude" => 85.1005,
                    "location_name" => "Angul Checkpoint",
                    "address" => "NH 55, Talcher Road",
                    "city" => "Angul",
                    "state" => "Odisha",
                    "country" => "India",
                    "ignition" => true,
                    "movement" => true,
                    "driver_name" => "Bikash Sahu",
                    "driver_mobile_number" => "9876543213",
                    "postal_code" => "759122"
                ],
                [
                    "id" => 5,
                    "vehicle_number" => "OD19JK1122",
                    "group_name" => "Cargo",
                    "timestamp" => "2025-04-15 12:05:00",
                    "nearest_site" => "Berhampur Center",
                    "speed" => 47.2,
                    "vehicle_regd_date" => "2021-08-15",
                    "nearest_site_km" => 2.8,
                    "idle_time" => "00:12:00",
                    "is_idle" => false,
                    "latitude" => 19.3149,
                    "longitude" => 84.7941,
                    "location_name" => "Berhampur Hub",
                    "address" => "Gopalpur Road",
                    "city" => "Berhampur",
                    "state" => "Odisha",
                    "country" => "India",
                    "ignition" => true,
                    "movement" => true,
                    "driver_name" => "Deepak Patra",
                    "driver_mobile_number" => "9876543214",
                    "postal_code" => "760005"
                ],
                [
                    "id" => 6,
                    "vehicle_number" => "OD22KL9988",
                    "group_name" => "Agriculture",
                    "timestamp" => "2025-04-15 12:15:00",
                    "nearest_site" => "Sambalpur Warehouse",
                    "speed" => 35.1,
                    "vehicle_regd_date" => "2022-12-05",
                    "nearest_site_km" => 1.0,
                    "idle_time" => "00:00:00",
                    "is_idle" => false,
                    "latitude" => 21.4669,
                    "longitude" => 83.9812,
                    "location_name" => "Sambalpur Check",
                    "address" => "NH6, Ainthapali",
                    "city" => "Sambalpur",
                    "state" => "Odisha",
                    "country" => "India",
                    "ignition" => true,
                    "movement" => true,
                    "driver_name" => "Niranjan Behera",
                    "driver_mobile_number" => "9876543215",
                    "postal_code" => "768004"
                ],
                [
                    "id" => 7,
                    "vehicle_number" => "OD13MN4567",
                    "group_name" => "Industrial Supply",
                    "timestamp" => "2025-04-15 12:30:00",
                    "nearest_site" => "Jharsuguda Plant",
                    "speed" => 50.3,
                    "vehicle_regd_date" => "2023-01-20",
                    "nearest_site_km" => 3.6,
                    "idle_time" => "00:07:45",
                    "is_idle" => false,
                    "latitude" => 21.8500,
                    "longitude" => 84.0300,
                    "location_name" => "Jharsuguda Industrial Zone",
                    "address" => "IB Thermal Road",
                    "city" => "Jharsuguda",
                    "state" => "Odisha",
                    "country" => "India",
                    "ignition" => true,
                    "movement" => true,
                    "driver_name" => "Arjun Panda",
                    "driver_mobile_number" => "9876543216",
                    "postal_code" => "768203"
                ]
            ];
            
            
            return response()->json([
                'success' => true,
                'message' => 'Locations retrieved successfully',
                'data' => $sites
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Locations: ' . $e->getMessage(),
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
