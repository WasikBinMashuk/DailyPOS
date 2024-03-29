@extends('backend.master')
@section('title', 'Product list')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="card-title">Filters</h3>
                            </div>
                        </div>
                        <div>
                            {{-- <div class="d-inline">
                                <a class="btn btn-info" href="#">Add</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div class="d-flex">
                            {{-- <div >
                    <h3 class="d-inline card-title">Products</h3>
                  </div> --}}
                            <div class="">
                                <h3 class="card-title">Product List (<span id="totalRecords"></span>)</h3>
                            </div>
                        </div>
                        <div>

                            <div class="d-inline">
                                <a class="btn btn-info" href="{{ route('product.create') }}">Add</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table " id="productTable">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Category ID</th> --}}
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Sub Category</th>
                                    <th scope="col">Product Code</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ URL::to('/products') }}",
                    data: function(d) {
                        d.status = $('#status').val(); // Send the status filter value
                    }
                },
                columns: [

                    {
                        data: 'product_image',
                        name: 'product_image'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'sub_category_name',
                        name: 'sub_category_name'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ],
                "initComplete": function(settings, json) {
                    // alert('DataTables has finished its initialisation.');
                    document.getElementById("totalRecords").innerHTML = table.page.info().recordsTotal;
                }
            });

            // Handle change event of status filter
            $('#status').on('change', function() {
                table.ajax.reload(); // Reload table data when status filter changes
            });
        });
    </script>
@endsection
