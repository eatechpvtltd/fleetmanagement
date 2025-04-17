@include ('components.adminheader')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="text-right mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add New <i data-feather="plus" class="icon-sm"></i>
                            </button>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ORGANIZATION</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('new-organization') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="orgName">Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        id="orgName" placeholder="Enter name">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="orgAddress">Address</label>
                                                    <input type="text" name="address" class="form-control"
                                                        id="orgAddress" placeholder="Enter address">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="orgPhone">Phone</label>
                                                    <input type="number" name="phone" class="form-control"
                                                        id="orgPhone" placeholder="Enter phone">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="orgEmail">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        id="orgEmail" placeholder="Enter email">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="orgTimezone">Timezone</label>
                                                    <input type="text" name="timezone" class="form-control"
                                                        id="orgTimezone" placeholder="Enter timezone">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="orgLogo">Logo</label>
                                                    <input type="file" name="file"
                                                        class="form-control form-control-file" id="orgLogo">
                                                </div>
                                            </div>

                                            <button type="submit" name="save"
                                                class="btn btn-success">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Timezone</th>
                                        <th>Logo</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($organization as $items)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $items->name }}</td>

                                            <td>{{ $items->address }}</td>
                                            <td>{{ $items->phone }}</td>
                                            <td>{{ $items->email }}</td>
                                            <td class="font-weight-medium">
                                                <div class="">{{ $items->timezone }}

                                                </div>
                                            </td>
                                            <td><img src="{{ url('Uploads/profiles/vehicles/' . $items->logo) }}"
                                                    width="100px"></td>
                                            <td class="font-weight-medium">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#updateModal{{ $i }}">
                                                    <i data-feather="edit" class="icon-sm"></i>
                                                </button>
                                                <a href="{{ url('delete-organization/' . $items->id) }}"
                                                    class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i data-feather="trash" class="icon-sm"></i></a>
                                                <div class="modal fade" id="updateModal{{ $i }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">UPDATE
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ URL::to('update-organization') }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $items->id }}">
                                                                
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="orgName">Name</label>
                                                                            <input type="text" name="name" id="orgName" class="form-control" placeholder="Enter name" value="{{ $items->name }}">
                                                                        </div>
                                                                
                                                                        <div class="form-group col-md-6">
                                                                            <label for="orgAddress">Address</label>
                                                                            <input type="text" name="address" id="orgAddress" class="form-control" placeholder="Enter address" value="{{ $items->address }}">
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="orgPhone">Phone</label>
                                                                            <input type="number" name="phone" id="orgPhone" class="form-control" placeholder="Enter phone" value="{{ $items->phone }}">
                                                                        </div>
                                                                
                                                                        <div class="form-group col-md-6">
                                                                            <label for="orgEmail">Email</label>
                                                                            <input type="email" name="email" id="orgEmail" class="form-control" placeholder="Enter email" value="{{ $items->email }}">
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="form-group">
                                                                        <label for="orgTimezone">Timezone</label>
                                                                        <input type="text" name="timezone" id="orgTimezone" class="form-control" placeholder="Enter timezone" value="{{ $items->timezone }}">
                                                                    </div>
                                                                
                                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                                </form>
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @include ('components.adminfooter')
