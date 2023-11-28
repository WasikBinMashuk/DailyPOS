@extends('backend.master')
@section('title', 'POS')
@section('content')
    <div class="">
        <div class="mx-2 mt-5">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header gap-5">
                            <div class="input-group w-50">
                                <button class="btn btn-outline-secondary " disabled><i class="fa-solid fa-user"></i></button>
                                <input type="text" class="form-control" placeholder="Walk-In Customer">
                                <a href="#" class="btn btn-outline-primary" type="button" id="button-addon2"><i
                                        class="fa-solid fa-plus"></i></a>
                            </div>
                            <div class="input-group ms-10 w-75">
                                <button class="btn btn-outline-secondary " disabled><i
                                        class="fa-solid fa-magnifying-glass-plus"></i></button>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="Enter Product Name">
                                <a href="#" class="btn btn-outline-primary" type="button" id="button-addon2"><i
                                        class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body" style="min-height:400px">
                            <table class="table table-striped table-hover table-bordered" id="product_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price (&#2547;)</th>
                                        <th scope="col">Total Price (&#2547;)</th>
                                        <th scope="col">Action</th>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class=" card-header justify-content-between ">
                            <div>
                                <h3 class="card-title">POS</h3>
                            </div>
                            <div>

                                <div class="d-inline">
                                    {{-- <a class="btn btn-info" href="{{ route('stocks.create') }}">Add</a> --}}
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row scrollable-div">
                                @foreach ($products as $product)
                                    <div class="col-md-3 mt-2">
                                        <div class="card" style="width: 8rem; height: 8rem;">
                                            <div class="card-body" style="text-align: center">
                                                @if ($product->product_image)
                                                    <img src="{{ asset('images/' . $product->product_image) }}"
                                                        class="card-img-top" style="height: 40px; width:40px;">
                                                @else
                                                    <img src="{{ asset('images/no.jpg') }}" class="card-img-top"
                                                        alt="...">
                                                @endif
                                            </div>
                                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                            <div class="card-body" style="text-align: center">
                                                <p class="card-text text-wrap fs-5 fw-bolder">{{ $product->product_name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
@endsection
