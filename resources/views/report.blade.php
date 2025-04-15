{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Summary Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4"> --}}
    @include ('components.adminheader')
 <!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Left Side: Form -->
                            <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h4 class="card-title text-center mb-4">Enter Trip Details</h4>
                                        <form id="tripForm">
                                            <div class="mb-3">
                                                <label for="group" class="form-label">Group</label>
                                                <select id="group" name="group" class="form-select form-control" required>
                                                    <option value="GT-BHUBANESWARI-PO">GT-BHUBANESWARI-PO</option>
                                                    <option value="GT-JHARSUGUDA-PO">GT-JHARSUGUDA-PO</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle" class="form-label">Vehicle</label>
                                                <select id="vehicle" name="vehicle" class="form-select form-control" required>
                                                    <option value="4150058701">OR-19-F-6477 MAY-25 (4150058701)</option>
                                                    <option value="4150058702">OR-19-F-6478 MAY-25 (4150058702)</option>
                                                    <option value="4150058703">OR-20-G-1234 MAY-25 (4150058703)</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="startDate" class="form-label">Start Date</label>
                                                <input type="datetime-local" id="startDate" name="startDate" class="form-control" value="2025-04-15T00:00" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="endDate" class="form-label">End Date</label>
                                                <input type="datetime-local" id="endDate" name="endDate" class="form-control" value="2025-04-15T23:59" required>
                                            </div>
                                            <button type="submit" class="btn btn-success w-100">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side: Display -->
                            <div class="col-md-8">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h4 class="card-title text-center mb-4">Trip Summary</h4>
                                        <div id="summaryInfo" class="mb-3"></div>
                                        <div id="noDataMessage" class="alert alert-warning d-none" role="alert">
                                            No trip data available for the selected criteria.
                                        </div>
                                        <div class="table-responsive">
                                            <table id="tripTable" class="table table-bordered table-striped d-none">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Site Name</th>
                                                        <th>Duration</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tripTableBody"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<script>
    const dummyData = [
        {
            "group": "GT-BHUBANESWARI-PO",
            "vehicles": [
                {
                    "vehicleId": "4150058701",
                    "vehicleName": "OR-19-F-6477 MAY-25",
                    "trips": [
                        {
                            "sn": 1,
                            "startTime": "2025-04-15 07:14",
                            "endTime": "2025-04-15 07:16",
                            "siteName": "pidha chak",
                            "duration": "0 Days 0 Hours 2 Minutes"
                        },
                        {
                            "sn": 2,
                            "startTime": "2025-04-15 07:17",
                            "endTime": "2025-04-15 07:38",
                            "siteName": "NO2 LOAD TRAFIC",
                            "duration": "0 Days 0 Hours 21 Minutes"
                        },
                        {
                            "sn": 3,
                            "startTime": "2025-04-15 07:40",
                            "endTime": "2025-04-15 07:41",
                            "siteName": "pidha chak",
                            "duration": "0 Days 0 Hours 1 Minutes"
                        }
                    ]
                },
                {
                    "vehicleId": "4150058702",
                    "vehicleName": "OR-19-F-6478 MAY-25",
                    "trips": [
                        {
                            "sn": 1,
                            "startTime": "2025-04-15 08:00",
                            "endTime": "2025-04-15 08:10",
                            "siteName": "biswal chak",
                            "duration": "0 Days 0 Hours 10 Minutes"
                        }
                    ]
                }
            ]
        },
        {
            "group": "GT-JHARSUGUDA-PO",
            "vehicles": [
                {
                    "vehicleId": "4150058703",
                    "vehicleName": "OR-20-G-1234 MAY-25",
                    "trips": []
                }
            ]
        }
    ];

    document.getElementById('tripForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const group = document.getElementById('group').value;
        const vehicleId = document.getElementById('vehicle').value;
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);

        const selectedGroup = dummyData.find(g => g.group === group);
        let trips = [];
        let vehicleName = '';

        if (selectedGroup) {
            const selectedVehicle = selectedGroup.vehicles.find(v => v.vehicleId === vehicleId);
            if (selectedVehicle) {
                vehicleName = selectedVehicle.vehicleName;
                trips = selectedVehicle.trips;
            }
        }

        const formatDate = (date) => {
            return date.toLocaleString('en-GB', {
                day: '2-digit', month: 'short', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });
        };

        document.getElementById('summaryInfo').innerHTML = `
            <p><strong>Group:</strong> ${group}</p>
            <p><strong>Vehicle:</strong> ${vehicleName} (ID: ${vehicleId})</p>
            <p><strong>Start Date:</strong> ${formatDate(startDate)}</p>
            <p><strong>End Date:</strong> ${formatDate(endDate)}</p>
        `;

        const table = document.getElementById('tripTable');
        const tableBody = document.getElementById('tripTableBody');
        const noDataMessage = document.getElementById('noDataMessage');

        if (trips.length > 0) {
            table.classList.remove('d-none');
            noDataMessage.classList.add('d-none');
            tableBody.innerHTML = trips.map(trip => `
                <tr>
                    <td>${trip.sn}</td>
                    <td>${trip.startTime}</td>
                    <td>${trip.endTime}</td>
                    <td>${trip.siteName}</td>
                    <td>${trip.duration}</td>
                </tr>
            `).join('');
        } else {
            table.classList.add('d-none');
            noDataMessage.classList.remove('d-none');
        }
    });
</script>
@include ('components.adminfooter')
{{-- </body>
</html> --}}
