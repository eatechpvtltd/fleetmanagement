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

                                            <label for="">Name</label>
                                            <input type="text" name="name" placeholder="Enter name"
                                                class="form-control mb-2" id="">
                                            <label for="">Address</label>
                                            <input type="text" name="address" placeholder="Enter address"
                                                class="form-control mb-2" id="">
                                            <label for="">phone</label>
                                            <input type="number" name="phone" class="form-control mb-2"
                                                id="">
                                            <label for="">Email</label>
                                            <input type="email" name="email" placeholder="Enter email"
                                                class="form-control mb-2" id="">
                                            <label for="">Timezone</label>
                                            <input type="text" name="timezone" placeholder="Enter timezone"
                                                class="form-control mb-2" id="">
                                            <label for="">Logo</label>
                                            <input type="file" name="file" value="logo" placeholder="Enter logo"
                                                class="form-control mb-2" id="">
                                            <input type="submit" name="save" value="Submit" class="btn btn-success">
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
                                                <a href="{{ url('delete-organization/' . $items->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">
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
                                                                <form action="{{ URL::to('update-organization') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <label for="">ID</label>
                                                                    <input type="number" name="id"
                                                                        value="{{ $items->id }}"
                                                                        placeholder="Enter id"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">name</label>
                                                                    <input type="text" name="name"
                                                                        value="{{ $items->name }}"
                                                                        placeholder="Enter name"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">Address</label>
                                                                    <input type="text" name="address"
                                                                        value="{{ $items->address }}"
                                                                        placeholder="Enter Address"
                                                                        class="form-control mb-2" id="">

                                                                    <label for="">Phone</label>
                                                                    <input type="number" name="phone"
                                                                        value="{{ $items->phone }}"
                                                                        placeholder="Enter Phone"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">email</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control mb-2" id=""
                                                                        value="{{ $items->email }}">
                                                                    <label for="">Timezone</label>
                                                                    <input type="text" name="timezone"
                                                                        value="{{ $items->timezone }}"
                                                                        placeholder="Enter Timezone"
                                                                        class="form-control mb-2" id="">

                                                                    <input type="submit" name="save"
                                                                        value="save changes" class="btn btn-success">
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
