@extends('backend.master')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">

        <div class="">
            <div class="">
                <form id="myForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Purchases</h3>
                        </div>
                        <div class=" card-body  ">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required">Date</label>
                                    <div class="input-icon mb-2">
                                        <input class="form-control" placeholder="Select a date" id="datepicker-icon"
                                            value="" />
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required">Select Supplier</label>
                                    <div>
                                        <select name="supplier_id" class="form-select" id="supplier_id">
                                            <option value="" selected disabled>--Select supplier--</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="supplier_id_error" class="error-message text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required">Status</label>
                                    <div>
                                        <select name="status" class="form-select" id="status">
                                            <option value="" selected disabled>--Select status--</option>
                                            <option value="received">Received</option>
                                            <option value="received">pending</option>
                                        </select>
                                        <span id="supplier_id_error" class="error-message text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required">Payment Method</label>
                                    <div>
                                        <select name="payment_method" class="form-select" id="payment_method">
                                            <option value="" selected disabled>--Select method--</option>
                                            <option value="Cash on delivery">Cash on delivery</option>
                                            <option value="Cash on delivery">Online payment</option>
                                        </select>
                                        <span id="supplier_id_error" class="error-message text-danger"></span>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <div class="card-footer text-end">
                            <button type="button" onclick="submitForm()" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mt-5">
                <div class="mb-3 card-body">
                    <label class="form-label ">Product Name</label>
                    <div>
                        <input type="text" class="form-control" name="product_name" placeholder="Enter product name"
                            id="employee_search">
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class=" card-header justify-content-between ">
                    <div>
                        <h3 class="card-title">Order Items</h3>
                    </div>
                    <div>

                        <div class="d-inline">
                            {{-- <a class="btn btn-info" href="{{ route('suppliers.create') }}">Add</a> --}}
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                {{-- <th scope="col">Category ID</th> --}}
                                <th scope="col">supplier Id</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Action</th>
                                {{-- <th scope="col"></th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td style="width: 100px">
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary">
                                            <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                        </a>
                                    </td>
                                    <td style="width: 100px">
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete this user?')">
                                                <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                            </button>
                                        </form>
                            </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                    {{-- {{ $suppliers->links('pagination::bootstrap-5') }} --}}
                </div>
                <div class="card-footer text-end">
                    <button onclick="storeDataInDatabase()" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Datepicker script --}}
    {{-- <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.Litepicker &&
                new Litepicker({
                    element: document.getElementById("datepicker-icon"),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                });
        });
        // @formatter:on
    </script> --}}


    <script>
        function submitForm() {
            let formData = new FormData(document.getElementById('myForm'));

            // Make an AJAX request to submit the form data
            $.ajax({
                url: '/purchases/submit-form',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Handle the response, update the table, etc.
                    updateTable(response.data);

                    // Clear previous errors
                    $('.error-message').text('');

                    // Clear the form
                    clearForm();
                },
                error: function(data) {
                    if (data.status === 422) {
                        var errors = data.responseJSON.errors;

                        // Clear previous errors
                        $('.error-message').text('');

                        // Display errors in your form
                        $.each(errors, function(key, value) {
                            // You can customize how you want to display the errors here
                            $('#' + key + '_error').text(value[0]);
                        });
                    } else {
                        // Handle other errors
                    }
                }
            });
        }

        function clearForm() {
            // Reset the form to clear all input fields
            document.getElementById('myForm').reset();
        }

        function updateTable(data) {
            // Update the table with the submitted data
            // You can append a new row to an existing table or update it as needed
            let newRow = `<tr>
                            <td>${data.supplier_id}</td>
                            <td>${data.product_name}</td>
                            <td>${data.quantity}</td>
                            <td>${data.price}</td>
                            <td>${data.total_price}</td>
                            <td><button onclick="deleteRow(this)" class="btn btn-danger">Delete</button></td>
                        </tr>`;

            // Assuming you have a table with the id 'dataTable'
            $('#dataTable tbody').append(newRow);
        }

        function deleteRow(button) {
            // Get the row to be deleted
            var row = button.parentNode.parentNode;

            // Remove the row from the table
            row.parentNode.removeChild(row);
        }

        function storeDataInDatabase() {
            // Get all rows from the table
            let tableData = [];
            $('#dataTable tbody tr').each(function() {
                let rowData = {
                    supplier_id: $(this).find('td:eq(0)').text(),
                    product_name: $(this).find('td:eq(1)').text(),
                    quantity: $(this).find('td:eq(2)').text(),
                    price: $(this).find('td:eq(3)').text(),
                    total_price: $(this).find('td:eq(4)').text(),
                };
                tableData.push(rowData);
            });

            // Make an AJAX request to store data in the database
            $.ajax({
                url: '/purchases/store-data',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    data: tableData
                },
                success: function(response) {
                    // Handle the response, e.g., show a success message
                    // console.log(response.message);
                },
                error: function(error) {
                    // Handle the error
                    console.error(error);
                }
            });
        }
    </script>

    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $("#employee_search").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ route('autoComplete') }}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#employee_search').val(ui.item.label); // display the selected text
                    $('#employeeid').val(ui.item.value); // save selected id to input
                    return false;
                },
                minLength: 2
            });

        });
    </script>
@endsection
