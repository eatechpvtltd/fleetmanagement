@include ('components.adminheader')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add New
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">VEHICLE</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="" method="GET" enctype="multipart/form-data">

                                            @csrf
                                    
                                            <label for="">License Plate</label>
                                            <input type="text" name="licenseplate" placeholder="Enter LICENSE PLATE"
                                                class="form-control mb-2" id="">
                                            <label for="">DRIVER</label>
                                            <input type="text" name="driver" placeholder="Enter DRIVER"
                                                class="form-control mb-2" id="">
                                            <label for="">MODEL</label>
                                            <input type="text" name="model" placeholder="Enter model"
                                                class="form-control mb-2" id="">
                                            <label for="">YEAR</label>
                                            <input type="text" name="year" class="form-control mb-2"
                                                id="">
                                            
                                            <input type="submit" name="save" value="save Now"
                                                class="btn btn-success">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Licence Plate</th>
                                        <th>Organization</th>
                                        <th>Driver</th>
                                        <th>Model</th>
                                        <th>Year</th>
                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

@include ('components.adminfooter')
