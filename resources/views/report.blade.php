@include ('components.adminheader')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card" style="background-color: #F5F7FF !important;">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card shadow bg-white">
                                    <div class="card-body">
                                        <h4 class="card-title text-center mb-4">New Trip Summary (Site) Report</h4>
                                        <form id="tripForm">
                                            <div class="mb-3">
                                                <label for="group" class="form-label">Group</label>
                                                <select id="group" name="group" class="form-select form-control" required>
                                                    <option value="">select</option>
                                                    <option value="GT-BHUBANESWARI-PO">GT-BHUBANESWARI-PO</option>
                                                    <option value="GT-JHARSUGUDA-PO">GT-JHARSUGUDA-PO</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="vehicle" class="form-label">Vehicle</label>
                                                <select id="vehicle" name="vehicle" class="form-select form-control" required>
                                                    <option value="">select</option>
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
                                            <button type="submit" class="btn btn-success w-100">View</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side: Display -->
                            <div class="col-md-8">
                                <div class="card shadow bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h4 class="card-title mb-0">Trip Summary</h4>
                                            <button class="btn btn-primary"><i data-feather="plus" class="icon-sm"></i></button>
                                        </div>
                                        <div id="summaryInfo" class="mb-3 d-flex"></div>
                                        <div id="noDataMessage" class="alert alert-warning d-none" role="alert">
                                            No trip data available for the selected criteria.
                                        </div>
                                        <div class="table-responsive">
                                            <table id="tripTable" class="table table-bordered table-striped" style="width:100%">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Site Name</th>
                                                        <th>Duration</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#tripTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '/api/trip-summary',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token for Laravel
            },
            data: function(d) {
                return $.extend({}, d, {
                    group: $('#group').val(),
                    vehicle: $('#vehicle').val(),
                    startDate: $('#startDate').val(),
                    endDate: $('#endDate').val()
                });
            },
            dataSrc: function(json) {
                // Update summary info
                $('#summaryInfo').html(`
                    <p class="col-6"><strong>Group:</strong> ${json.group}</p>
                    <p class="col-6 text-end"><strong>Vehicle:</strong> ${json.vehicleName} (ID: ${json.vehicleId})</p>
                `);

                // Show/hide no data message
                $('#noDataMessage').toggleClass('d-none', json.data.length > 0);

                return json.data;
            },
            error: function(xhr, error, thrown) {
                $('#noDataMessage').removeClass('d-none');
                $('#summaryInfo').html('');
                return [];
            }
        },
        columns: [
            { data: 'sn' },
            { data: 'startTime' },
            { data: 'endTime' },
            { data: 'siteName' },
            { data: 'duration' },
            {
                data: null,
                render: function(data, type, row) {
                    return '<a class="btn btn-primary btn-sm"><i data-feather="edit" class="icon-sm"></i></a>';
                }
            }
        ],
        drawCallback: function() {
            feather.replace(); // Re-initialize feather icons after table draw
        }
    });

    // Form submission handler
    $('#tripForm').on('submit', function(e) {
        e.preventDefault();
        table.ajax.reload(); // Reload DataTable with new form data
    });
});
</script>
@include ('components.adminfooter')