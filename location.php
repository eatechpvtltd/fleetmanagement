<?php
// vehicle_tracker_api.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$filename = "vehicle_location.json";

// If there's POST data, save the location
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['vehicle_id']) && isset($data['latitude']) && isset($data['longitude'])) {
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(["status" => "success", "message" => "Location updated"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid data"]);
    }
    exit;
}

// For GET requests, return the last known location
if (file_exists($filename)) {
    $locationData = json_decode(file_get_contents($filename), true);
    echo json_encode(["status" => "success", "location" => $locationData]);
} else {
    echo json_encode(["status" => "error", "message" => "No data available"]);
}
?>