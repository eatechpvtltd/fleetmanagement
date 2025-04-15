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
                                        <h5 class="modal-title" id="exampleModalLabel">ORGANIZATION</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="{{ URL::to('AddNewOrg') }}" method="POST" enctype="multipart/form-data">

                                            @csrf
                                    
                                            <label for="">Name</label>
                                            <input type="text" name="name" placeholder="Enter name"
                                                class="form-control mb-2" id="">
                                            <label for="">Logo</label>
                                            <input type="file" name="logo" placeholder="Enter logo"
                                                class="form-control mb-2" id="">
                                            <label for="">ADDRESS</label>
                                            <input type="text" name="address" placeholder="Enter address"
                                                class="form-control mb-2" id="">
                                            <label for="">phone</label>
                                            <input type="number" name="phone" class="form-control mb-2"
                                                id="">
                                            <label for="">EMAIL</label>
                                            <input type="email" name="email" placeholder="Enter email"
                                                class="form-control mb-2" id="">
                                                <label for="">TIMEZONE</label>
                                            <input type="text" name="timezone" placeholder="Enter timezone"
                                                class="form-control mb-2" id="">
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
                                        <th>Name</th>
                                        <th>LOGO</th>
                                        <th>ADDRESS</th>
                                        <th>PHONE</th>
                                        <th>EMAIL</th>
                                         <th>TIMEZONE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    {{-- @foreach ($products as $items)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $items->title }}</td>
                                            <td><img src="{{ url('Uploads/profiles/products/' . $items->picture) }}"
                                                    width="100px"></td>
                                            <td>{{ $items->price }}</td>
                                            <td>{{ $items->quantity }}</td>
                                            <td>{{ $items->category }}</td>
                                            <td class="font-weight-medium">
                                                <div class="">{{ $items->type }}</div>
                                            </td>
                                            <td class="font-weight-medium">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#updateModal{{ $i }}">
                                                    Update
                                                </button>

                                                <div class="modal fade" id="updateModal{{ $i }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">UPDATE
                                                                    PRODUCTS</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ URL::to('UpdateProduct') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <label for="">ID</label>
                                                                    <input type="number" name="id"
                                                                        value="{{ $items->id }}"
                                                                        placeholder="Enter id"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">Title</label>
                                                                    <input type="text" name="title"
                                                                        value="{{ $items->title }}"
                                                                        placeholder="Enter Title"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">Price</label>
                                                                    <input type="text" name="price"
                                                                        value="{{ $items->price }}"
                                                                        placeholder="Enter Price"
                                                                        class="form-control mb-2" id="">

                                                                    <label for="">Quantity</label>
                                                                    <input type="number" name="quantity"
                                                                        value="{{ $items->quantity }}"
                                                                        placeholder="Enter Quantity"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">Picture</label>
                                                                    <input type="file" name="file"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">Description</label>
                                                                    <input type="text" name="description"
                                                                        value="{{ $items->description }}"
                                                                        placeholder="Enter Description"
                                                                        class="form-control mb-2" id="">
                                                                    <label for="">Category</label>
                                                                    <select name="category" clas="form-control mb-2"
                                                                        id="">
                                                                        <option value="{{ $items->category }}">
                                                                            {{ $items->category }}</option>
                                                                        <option value="accessories">Accessories
                                                                        </option>
                                                                        <option value="shoe">shoes</option>
                                                                        <option value="clothe">clothes</option>
                                                                    </select>
                                                                    <select name="type" clas="form-control mb-2"
                                                                        id="">
                                                                        <option value="{{ $items->type }}">
                                                                            {{ $items->type }}</option>
                                                                        <option value="Best Sellers">Best Sellers
                                                                        </option>
                                                                        <option value="new-arrivals">New-Arrivals
                                                                        </option>
                                                                        <option value="sale">sale</option>
                                                                    </select>
                                                                    <input type="submit" name="save"
                                                                        value="save changes" class="btn btn-success">
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ URL::to('deleteProduct/' . $items->id) }}"
                                                    class="btn btn-danger">DELETE</a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

@include ('components.adminfooter')
