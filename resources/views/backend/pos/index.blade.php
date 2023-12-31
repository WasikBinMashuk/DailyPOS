@extends('backend.master')
@section('title', 'POS')
@section('content')
    <div class="">
        <div class="mx-2 mt-5">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header gap-2 justify-content-around">
                            <div class="input-group w-25">
                                <button class="btn btn-outline-secondary " disabled><i class="fa-solid fa-user"></i></button>
                                <input type="text" class="form-control" id="customer_id" name="customer_id"
                                    placeholder="Walk-In Customer">
                                <a href="{{ route('customers.create') }}" target="_blank" title="Create Customer"
                                    class="btn btn-outline-primary" type="button" id="button-addon2"><i
                                        class="fa-solid fa-plus"></i></a>
                                <div><span id="customer_id_error" class="error-message text-danger"></span></div>
                            </div>
                            <div class="input-group ms-10 w-50">
                                <button class="btn btn-outline-secondary " disabled><i
                                        class="fa-solid fa-magnifying-glass-plus"></i></button>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="Enter Product Name">
                                <a href="{{ route('product.create') }}" target="_blank" title="Create Product"
                                    class="btn btn-outline-primary" type="button" id="button-addon2"><i
                                        class="fa-solid fa-plus"></i></a>
                            </div>
                            <div>
                                <select name="branch_id" id="branch_id" class="form-select" title="Branch"
                                    style="cursor: pointer;">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $branch->default == '1' ? 'selected' : '' }}>
                                            {{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body posTableDiv">
                            {{-- Loader --}}
                            <div class="card-loader-div">
                                <img class="loader-img" src="{{ asset('gif/loader.gif') }}"
                                    style="height: 120px;width: auto;" />
                            </div>

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
                        <div class="d-flex card-footer gap-2 justify-content-end">
                            <div class="input-group w-25">
                                <span class="input-group-text">Due</span>
                                <input type="text" id="due_amount" name="due_amount" class="form-control shadow-none"
                                    readonly style="outline: none; border-color:rgb(230, 230, 230)">
                            </div>
                            <div class="input-group w-25">
                                <span class="input-group-text">Pay</span>
                                <input type="text" id="pay_amount" name="pay_amount" class="form-control"
                                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                <span id="pay_amount_error" class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-2">
                        <div>
                            <button type="button" class="btn btn-warning" data-pay_method="cash"
                                title="Mark complete paid & checkout"> <i class="fas fa-credit-card pe-2"
                                    aria-hidden="true"></i>
                                Card</button>

                        </div>
                        <div class="ms-1">
                            <button type="button" onclick="storeSellDataInDatabase()" class="btn btn-success"
                                data-pay_method="cash" id="sell-button" title="Mark complete paid & checkout">
                                <i class="fas fa-money-bill-alt pe-2" aria-hidden="true"></i>
                                Cash
                            </button>
                        </div>
                        <div class="pos-total">
                            <span>Total Payable: <span id="total-payable">0</span></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class=" card-header justify-content-between ">
                            <div>
                                <h3 class="card-title">Products</h3>
                            </div>
                            <div>

                                <div class="d-inline">
                                    {{-- <a class="btn btn-info" href="{{ route('stocks.create') }}">Add</a> --}}
                                    {{-- <select name="select_box" class="form-select" id="select_box">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select class="form-select form-select-sm" id="category-select"
                                        data-placeholder="All Categories" style="width: 200px">
                                        <option value="0" selected>All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row scrollable-div">
                                <div id="data-wrapper">
                                    <div class="row" id="product-data">
                                        @include('backend.pos.data')
                                    </div>
                                </div>
                                <div class="product-show-loader text-center mt-2" style="display: none;">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border text-info" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        {{-- <img class="" src="{{ asset('gif/loader.gif') }}"
                                            style="height: 120px;width: auto;" /> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loader-div">
        <img class="loader-img" src="{{ asset('gif/loader.gif') }}" style="height: 120px;width: auto;" />
    </div>

    <script type="text/javascript">
        var ENDPOINT = "{{ route('pos.products') }}";
        var hasMorePages = true;
        var page = 1;
        var count = 0; // count variable to force stop html empty return condition
        var selectedBranchId;


        $(document).ready(function() {

        });

        function fetchBranchwiseProducts(selectedBranchId) {
            page = 1;
            hasMorePages = true;
            count = 0;
            // console.log(page);
            $.ajax({
                    url: "{{ route('pos.products') }}",
                    type: 'GET',
                    datatype: "html",
                    data: {
                        branch_id: selectedBranchId
                    },
                    beforeSend: function() {
                        $('.product-show-loader').show();
                    }
                }).done(function(response) {
                    if (response.html == '' && count == 0) {
                        $('.product-show-loader').hide();
                        $('#no-product').remove();
                        $("#product-data").html(response.html);
                        $("#data-wrapper").append(
                            "<div class='mt-5 text-center' id='no-product'>No Products Found</div>");
                        hasMorePages = false;
                        count = 1;
                        return;
                    }

                    $('.product-show-loader').hide();
                    // $("#data-wrapper").append("<div class='row'>" + response.html + "</div>");
                    // $("#product-data").append(response.html);
                    $("#product-data").html(response.html);
                    $('#no-product').remove();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

        // Product table scroll to view more data and Select2 features
        $('.scrollable-div').scroll(function() {
            var element = $(this);
            if ((element.scrollTop() + element.innerHeight() >= (element[0].scrollHeight - 20)) && hasMorePages) {
                page++;
                LoadMore(page);
            }
        });

        function LoadMore(page) {
            // alert("Page : " + page);
            $.ajax({
                    url: ENDPOINT + "?page=" + page,
                    datatype: "html",
                    type: "get",
                    data: {
                        branch_id: selectedBranchId
                    },
                    beforeSend: function() {
                        $('.product-show-loader').show();
                    }
                })
                .done(function(response) {
                    if (response.html == '' && count == 0) {
                        $('.product-show-loader').hide();
                        $("#data-wrapper").append(
                            "<div class='mt-5 text-center' id='no-product'>No More Products</div>");
                        hasMorePages = false;
                        count = 1;
                        return;
                    }

                    $('.product-show-loader').hide();
                    // $("#data-wrapper").append("<div class='row'>" + response.html + "</div>");
                    $("#product-data").append(response.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

        // Select2 dropdown for category selection
        $('#category-select').select2({
            theme: "bootstrap-5",
            // width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            // width: 'element',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#category-select').parent(),
        });
        $('#category-select').on('select2:select', function(e) {
            // var data = e.params.data;
            var categoryId = e.params.data.id;
            $.ajax({
                url: "{{ route('pos.product.filter') }}",
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.product-show-loader').show();
                },
                data: {
                    cid: categoryId,
                    branch_id: selectedBranchId
                },
                success: function(response) {
                    if (response.html == '') {
                        $('.product-show-loader').hide();
                        $('#no-product').remove();
                        $("#product-data").html(response.html);
                        $("#data-wrapper").append(
                            "<div class='mt-5 text-center' id='no-product'>No Products Found</div>");
                        // hasMorePages = false;
                        // count = 1;
                        return;
                    }
                    if (response.flag == 1) {
                        hasMorePages = true;
                        page = 1;
                        count = 0;
                    } else {
                        hasMorePages = false; //making it false to stop scrolling on filter data
                    }

                    $('.product-show-loader').hide();

                    // $("#data-wrapper").append("<div class='row'>" + response.html + "</div>");
                    $("#product-data").html(response.html);
                    $('#no-product').remove();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });

        // -----------------------------AutoComplete for product search and update table--------------------------------------------------------
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $("#product_name").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ route('autoComplete.pos.product') }}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term,
                            branch_id: selectedBranchId
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

                    $(".card-loader-div").show(); // show loader
                    setTimeout(function() {
                        // Update the table with selected product information
                        updateTable(ui.item.value, ui.item.label, ui.item.price, 1, ui.item
                            .stock);
                    }, 200);

                    // Clear the input field
                    $('#product_name').val('');

                    return false;
                },
                minLength: 2
            });

            //making pay-due input fields disable
            $('#pay_amount, #due_amount').prop('disabled', true);

            function updateTable(productId, productName, productPrice, quantity, stock) {
                var table = $('#product_table');
                // Checking if the product already exists in the table
                var existingRow = table.find('tr[data-product-id="' + productId + '"]');
                if (existingRow.length > 0) {
                    // Product already exists, update the quantity
                    var quantityInput = existingRow.find('.quantity-input');

                    //showing an alert on max quantity changes
                    if (parseInt(quantityInput.val()) == stock) {
                        alert('Max Stock: ' + stock);
                        $(".card-loader-div").hide(); // hide loader
                        return;
                    }
                    var newQuantity = parseInt(quantityInput.val()) + 1;
                    quantityInput.val(newQuantity);

                    // Update the Total Price based on the new quantity
                    var totalPrice = newQuantity * productPrice;
                    existingRow.find('.total-price').text(totalPrice);
                } else {
                    // Product doesn't exist, add a new row
                    var newRow = $('<tr data-product-id="' + productId + '"><td>' + productId + '</td><td>' +
                        productName +
                        '</td><td><input style="width: 60px;" type="number" name="quantity-inp" class="quantity-input" min="1" max="' +
                        stock + '" value="' +
                        quantity + '"></td><td class="base-price">' + productPrice +
                        '</td><td class="total-price">' + productPrice +
                        '</td><td><button class="btn btn-danger remove-btn"><i class="fa-regular fa-trash-can" style="color: #ffffff;"></i></button></td></tr>'
                    );
                    table.find('tbody').append(newRow);

                    // Shows the footer
                    toggleTableFooter();

                    //shows the pay-due fields
                    togglePayDueFields();
                }
                $(".card-loader-div").hide(); // hide loader

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
                var maxStock = $(this).attr("max");

                //showing an alert on max quantity changes
                if (parseInt(maxStock) < parseInt(newQuantity)) {
                    alert('Max Stock: ' + maxStock);
                    $(this).val(maxStock);
                    totalPrice = maxStock * basePrice;
                    $(this).closest('tr').find('.total-price').text(totalPrice);
                    // Update the subtotal
                    updateSubtotal();
                    return;
                }
                $(this).closest('tr').find('.total-price').text(totalPrice);

                // Update the subtotal
                updateSubtotal();

            });

            // click event listener for the product cards
            $(document).on('click', '.pos-product-card', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var productName = $(this).data('name');
                var productPrice = $(this).data('price');
                var productStock = $(this).data('stock');

                $(".card-loader-div").show(); // show loader
                setTimeout(function() {
                    // Update the table with selected product information
                    updateTable(productId, productName, productPrice, 1, productStock);

                }, 200);

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
                $('#total-payable').text(subtotal);

                //Update pay-due fields
                $('#pay_amount').val(subtotal);
                $('#due_amount').val(0);

                // document.getElementById('total-payable').innerHTML = 'Total Payable: ' + subtotal;

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

                var subTotal = parseFloat(document.getElementById("subtotal").innerText);

                if (isNaN(subTotal)) {
                    subTotal = 0;
                }

                if (!isNaN(rowTotalPrice)) {
                    subTotal -= rowTotalPrice;
                }

                // Update the subtotal cell at the bottom of the table
                $('#subtotal').text(subTotal);

                // Update the total payable div
                $('#total-payable').text(subTotal);

                //Update pay-due fields
                $('#pay_amount').val(subTotal);
                $('#due_amount').val(0);

                // Remove the row
                row.remove();

                //hides the footer
                toggleTableFooter();

                // hides the pay-due fields
                togglePayDueFields();
            });

            // pay-due fields logic
            function togglePayDueFields(disable) {
                var tableRows = $('#product_table tbody tr');

                // Check if there are any rows
                if (tableRows.length > 0) {
                    $('#pay_amount, #due_amount').prop('disabled', false);
                } else {
                    $('#pay_amount, #due_amount').prop('disabled', true);
                }
            }

            // event listener for the "Pay" input field
            $('#pay_amount').on('input', function() {
                var payValue = $(this).val();

                // Remove any non-numeric characters
                payValue = payValue.replace(/[^0-9.]/g, '');

                // Ensure that the entered "Pay" value is a non-negative number
                var parsedPayValue = parseFloat(payValue) || 0;

                $(this).val(parsedPayValue);

                // Get the subtotal value
                var subtotal = parseFloat($('#subtotal').text()) || 0;

                // Ensure that the entered "Pay" value is not greater than the subtotal
                if (parsedPayValue > subtotal) {
                    alert('Pay amount cannot exceed subtotal amount.');
                    $(this).val(subtotal); // Set the "Pay" value to the subtotal
                }

                var due = subtotal - payValue;

                //show "0" if due is negative
                $('#due_amount').val(due >= 0 ? due : 0);
            });

            // branch change triggering
            $('#branch_id').change(function() {
                // Get the branch_id
                selectedBranchId = $(this).val();

                // make all categories selected after changing every branch
                $('#category-select').val('0');
                $('#category-select').trigger('change');

                // Clear the table body
                $("#product_table tbody").empty();
                // Hide the table footer
                $("#product_table tfoot").hide();

                // Update the subtotal cell at the bottom of the table
                $('#subtotal').text(0);
                $('#total-payable').text(0);

                //Update pay-due fields
                $('#pay_amount').val(0);
                $('#due_amount').val(0);
                // hides the pay-due fields
                togglePayDueFields();

                // Make AJAX call to fetch data based on the selected value
                fetchBranchwiseProducts(selectedBranchId);
            });

            // Trigger the change event on page load to make an initial AJAX call
            $('#branch_id').trigger('change');
        });

        function storeSellDataInDatabase() {

            // var rowCount = document.getElementById('product_table').rows.length;

            if ($('#product_table tbody tr').length == 0) {
                alert('No rows in product_table. Cannot store sell data.');
                return;
            }

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
                    // customer_id: $('#customer_id').val(),
                    customer_id: $('#customer_id').data('customer_id'),
                    branch_id: $('#branch_id').val(),
                    pay_amount: $('#pay_amount').val(),
                    due_amount: $('#due_amount').val(),
                    payment_method: "cash",
                    subtotal: $('#subtotal').text(),
                };
                tableData.push(rowData);
            });

            // Clear previous errors
            // $('.error-message').text('');

            // Make an AJAX request to store data in the database
            $.ajax({
                url: "{{ route('pos.store') }}",
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    data: tableData
                },
                success: function(response) {
                    // Handle the response, e.g., show a success message
                    // console.log(response.message);
                    var sell_id = response.id;
                    $.ajax({
                        url: "{{ route('pdf.download') }}",
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            sell_id: sell_id
                        },
                        success: function() {
                            console.log('PDF download AJAX call completed');
                        },
                        error: function(data) {
                            console.log('error in pdf download ajax call');
                            console.log(data.responseJSON.errors);
                        }
                    });

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
                        // location.reload();
                        console.log('Something went wrong while store Ajax');
                    }
                }
            });
        }
    </script>

    {{-- AutoComplete for Customer search --}}
    <script>
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $("#customer_id").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ route('autoComplete.customer') }}",
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
                    $('#customer_id').val(ui.item.label); // display the selected text
                    // $('#customer_id').val(ui.item.value); // save selected id to input
                    $('#customer_id').data('customer_id', ui.item.value);

                    // Clear previous errors
                    $('.error-message').text('');

                    return false;
                },
                minLength: 2
            });
        });
    </script>


@endsection
