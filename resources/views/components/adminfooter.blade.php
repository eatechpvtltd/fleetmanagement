<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
     
    </div>
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
     
    </div>
  </footer> 
  <!-- partial -->
</div>
<!-- main-panel ends -->
</div>   
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset('Dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('Dashboard/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('Dashboard/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('Dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('Dashboard/js/dataTables.select.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('Dashboard/js/off-canvas.js') }}"></script>
<script src="{{ asset('Dashboard/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('Dashboard/js/template.js') }}"></script>
<script src="{{ asset('Dashboard/js/settings.js') }}"></script>
<script src="{{ asset('Dashboard/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('Dashboard/js/dashboard.js') }}"></script>
<script src="{{ asset('Dashboard/js/Chart.roundedBarCharts.js') }}"></script>

<!-- DataTables AJAX Setup for Laravel -->
<script>
// $(document).ready(function() {
//     $('#example').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: "",
//             type: "GET",
//             error: function(jqXHR, textStatus, errorThrown) {
//                 console.log('AJAX Error:', textStatus);
//                 alert('Failed to load data. Please try again.');
//             }
//         },
//         columns: [
//             { data: 'id', name: 'id' },
//             { data: 'name', name: 'name' },
//             { data: 'email', name: 'email' },
//             // Add more columns as needed
//         ],
//         responsive: true,
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ],
//         select: true
//     });
// });
feather.replace();
</script>
</body>

</html>

