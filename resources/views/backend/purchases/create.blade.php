@extends('backend.master')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">

        <div class="">
            <div class="">
                <form id="myForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Make a Purchase</h3>
                        </div>
                        <div class=" card-body  ">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required">Date</label>
                                    <div class="input-icon mb-2">
                                        <input class="form-control" name="date" placeholder="Select a date"
                                            id="datepicker-icon" value="" />
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
                                    <span id="date_error" class="error-message text-danger"></span>
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
                                            <option value="pending">Pending</option>
                                        </select>
                                        <span id="status_error" class="error-message text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required">Payment Method</label>
                                    <div>
                                        <select name="payment_method" class="form-select" id="payment_method">
                                            <option value="" selected disabled>--Select method--</option>
                                            <option value="cod">COD</option>
                                            <option value="online">Online</option>
                                        </select>
                                        <span id="payment_method_error" class="error-message text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label required">Select Branch</label>
                                    <div>
                                        <select name="branch_id" class="form-select" id="branch_id">
                                            <option value="" selected disabled>--Select method--</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="branch_id_error" class="error-message text-danger"></span>
                                    </div>
                                </div>


                            </div>


                        </div>
                        {{-- <div class="card-footer text-end">
                            <button type="button" onclick="submitForm()" class="btn btn-primary">Add</button>
                        </div> --}}
                    </div>
                </form>
            </div>
            <div class="card mt-5">
                <div class="mb-3 card-body">
                    <label class="form-label ">Select Products</label>
                    <div>
                        <input type="text" class="form-control" name="product_name" placeholder="Enter product name"
                            id="product_name">
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
                    <table class="table " id="product_table">
                        <thead>
                            <tr>
                                {{-- <th scope="col">Category ID</th> --}}
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price (&#2547;)</th>
                                <th scope="col">Total Price (&#2547;)</th>
                                <th scope="col">Action</th>
                                {{-- <th scope="col"></th> --}}

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot style="display: none;">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Subtotal:</th>
                                <td id="subtotal"></td>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- {{ $suppliers->links('pagination::bootstrap-5') }} --}}
                </div>
                <div class="card-footer d-grid gap-2 col-6 mx-auto">
                    <button onclick="storeDataInDatabase()" id="submit-button" class="btn btn-success"
                        style="display: none;">Submit</button>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
    <div class="loader-div">
        <img class="loader-img" src="{{ asset('gif/loader.gif') }}" style="height: 120px;width: auto;" />
    </div>

    {{-- Datepicker script --}}
    <script>
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
    </script>


    {{-- <script>
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
    </script> --}}

    {{-- JQuery autocomplete UI, Update dependant table --}}
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $("#product_name").autocomplete({
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
                    // $('#product_name').val(ui.item.label); // display the selected text
                    // $('#product_name').val(ui.item.value); // save selected id to input

                    // Update the table with selected product information
                    updateTable(ui.item.value, ui.item.label, ui.item.price, 1);

                    // Clear the input field
                    $('#product_name').val('');

                    return false;
                },
                minLength: 2
            });

            function updateTable(productId, productName, productPrice, quantity) {
                var table = $('#product_table');
                // Checking if the product already exists in the table
                var existingRow = table.find('tr[data-product-id="' + productId + '"]');
                if (existingRow.length > 0) {
                    // Product already exists, update the quantity
                    var quantityInput = existingRow.find('.quantity-input');
                    var newQuantity = parseInt(quantityInput.val()) + 1;
                    quantityInput.val(newQuantity);

                    // Update the Total Price based on the new quantity
                    var totalPrice = newQuantity * productPrice;
                    existingRow.find('.total-price').text(totalPrice);

                } else {
                    // Product doesn't exist, add a new row
                    var newRow = $('<tr data-product-id="' + productId + '"><td>' + productId + '</td><td>' +
                        productName +
                        '</td><td><input style="width: 60px;" type="number" name="quantity-inp" class="quantity-input" min="1" value="' +
                        quantity + '"></td><td class="base-price">' + productPrice +
                        '</td><td class="total-price">' + productPrice +
                        '</td><td><button class="btn btn-danger remove-btn"><i class="fa-regular fa-trash-can" style="color: #ffffff;"></i></button></td></tr>'
                    );
                    table.find('tbody').append(newRow);

                    // Shows the footer
                    toggleTableFooter();
                }
                // Update the subtotal
                updateSubtotal();
            }

            // Handle quantity changes
            $('#product_table').on('click', '.quantity-input', function() {
                // Prevent propagation to avoid unwanted behaviors
                event.stopPropagation();
            });

            $('#product_table').on('input', '.quantity-input', function() {
                var newQuantity = $(this).val();
                var basePrice = $(this).closest('tr').find('.base-price').text();
                var totalPrice = newQuantity * basePrice;
                $(this).closest('tr').find('.total-price').text(totalPrice);

                // Update the subtotal
                updateSubtotal();

                // Optionally, you can send an AJAX request to update the server-side quantity
                // and recalculate the total price.
            });

            // updating subtotal price
            function updateSubtotal() {
                var subtotal = 0;
                // Iterate through each row and add up the product prices
                $('#product_table tbody tr').each(function() {
                    var price = parseFloat($(this).find('.total-price').text());
                    if (!isNaN(price)) {
                        subtotal += price;
                    }
                });

                // Update the subtotal cell at the bottom of the table
                $('#subtotal').text(subtotal);
            }

            //Handle table footer hide/show
            function toggleTableFooter() {
                var tableRows = $('#product_table tbody tr'); // Select all rows in the table body
                var tableFooter = $('#product_table tfoot'); // Select the table footer
                var submitButton = $('#submit-button'); //Select submit button

                // Check if there are any rows
                if (tableRows.length > 0) {
                    tableFooter.show(); // If there are rows, show the table footer
                    submitButton.show(); // If there are rows, show the submit button
                } else {
                    tableFooter.hide(); // If there are no rows, hide the table footer
                    submitButton.hide(); // If there are rows, hide the submit button
                }
            }

            // Handle row removal
            $('#product_table').on('click', '.remove-btn', function() {
                var row = $(this).closest('tr');
                var rowTotalPrice = parseFloat(row.find('.total-price').text());

                var subTotal = document.getElementById("subtotal").innerText;

                if (!isNaN(rowTotalPrice)) {
                    subTotal -= rowTotalPrice;
                }

                // Update the subtotal cell at the bottom of the table
                $('#subtotal').text(subTotal);

                // Remove the row
                row.remove();

                //hides the footer
                toggleTableFooter();
            });

        });
    </script>

    <script type="text/javascript">
        function storeDataInDatabase() {

            $(".loader-div").show(); // show loader

            // Get all rows from the table
            let tableData = [];
            $('#product_table tbody tr').each(function() {
                let rowData = {
                    product_id: $(this).find('td:eq(0)').text(),
                    // product_name: $(this).find('td:eq(1)').text(),
                    quantity: $(this).find('input[name="quantity-inp"]').val(),
                    price: $(this).find('td:eq(3)').text(),
                    total_price: $(this).find('td:eq(4)').text(),
                    date: $('#datepicker-icon').val(),
                    supplier_id: $('#supplier_id').val(),
                    branch_id: $('#branch_id').val(),
                    status: $('#status').val(),
                    payment_method: $('#payment_method').val(),
                    subtotal: $('#subtotal').text(),
                };
                tableData.push(rowData);
            });

            // Clear previous errors
            // $('.error-message').text('');

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

                    // Reload the page
                    location.reload();

                    $(".loader-div").hide(); // hide loader
                },
                error: function(data) {
                    if (data.status === 422) {
                        var errors = data.responseJSON.errors;

                        $(".loader-div").hide(); // hide loader

                        // Clear previous errors
                        $('.error-message').text('');

                        // Display errors in your form
                        $.each(errors, function(key, value) {
                            // You can customize how you want to display the errors here
                            $('#' + key + '_error').text(value[0]);
                        });
                    } else {
                        // Handle other errors
                        // Reload the page
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
