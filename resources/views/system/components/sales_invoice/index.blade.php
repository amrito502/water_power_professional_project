@extends('system.master')

@section('content')


<div class="row mb-5">
    <div class="col-md-6">
        <h1>Create Sales Invoice</h1>
    </div>
    <div class="col-md-6 mt-2 d-flex justify-content-end">
        <a href="" class="btn btn-info mx-3">Print Invoice</a>
        <a href="" class="btn btn-success">Return Invoice</a>
    </div>
</div>
@if (session('success'))
    <div class="alert alert-success">
        <p class="my-3 text-success">{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="cards">
    <form id="invoiceForm" action="{{ route('sales_invoices.store') }}" method="POST">
        @csrf
        <div class="row mb-4">
            <div class="col-md-6 position-relative d-flex">
                <input type="text" class="form-control search_customer" style="border: none" placeholder="Search Customer">
                <input type="text" class="form-control search_sku mx-2" style="border: none" placeholder="Search SKU Name">
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4 d-flex">
                <input type="text" name="invoice_no" class="form-control invoice_no mx-2" style="border: none" value="IN{{ now()->format('ymdhis') }}" readonly>
                <input type="date" name="invoice_date" class="form-control invoice_date" style="border: none" value="{{ now()->toDateString() }}">
            </div>
        </div>
        <ul class="list-group customer_suggestions mb-3" style="display: none; color: red;"></ul>
        <!-- Totals Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-2">
                            <strong>Total Quantity:</strong>
                            <span id="totalQuantity">0</span>
                        </div>
                        <div class="col-md-2">
                            <strong>Total Amount:</strong>
                            <span id="totalAmount">0.00</span>
                        </div>
                        <div class="col-md-2">
                            <strong>Total Tax:</strong>
                            <span id="totalTax">0.00</span>
                        </div>
                        <div class="col-md-2">
                            <strong>Sub Total:</strong>
                            <span id="subTotal">0.00</span>
                        </div>
                        <div class="col-md-2">
                            <strong>Total Discount:</strong>
                            <span id="totalDiscount">0.00</span>
                        </div>
                        <div class="col-md-2">
                            <strong>Grand Total:</strong>
                            <span id="grandTotal">0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table id="customerTable" class="table table-bordered mt-3" style="display: none;">
            <thead>
                <tr>
                    <th>Shop</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be added dynamically here -->
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SKU Code</th>
                    <th>SKU Name</th>
                    <th>Quantity</th>
                    <th>Sell Price</th>
                    <th>Disc %</th>
                    <th>Disc Amount</th>
                    <th>Tax %</th>
                    <th>Tax Amount</th>
                    <th>Current Stock</th>
                    <th>Net Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="invoiceItems">
                <!-- Initial Row -->
                <tr class="item-row">
                    <td><input type="text" name="sku_codes[]" placeholder="SKU Code" class="form-control sku_code"></td>
                    <td><input type="text" name="sku_names[]" placeholder="SKU Name" class="form-control sku_name" readonly></td>
                    <td><input type="number" name="quantities[]" value="0" class="form-control quantity"></td>
                    <td><input type="text" name="sales_prices[]" value="0" class="form-control sales_price" readonly></td>
                    <td><input type="text" name="discounts[]" value="0" class="form-control discount_percent"></td>
                    <td><input type="text" name="discount_amounts[]" value="0" class="form-control discount_amount" readonly></td>
                    <td><input type="text" name="taxes[]" value="0" class="form-control tax" readonly></td>
                    <td><input type="text" name="tax_amounts[]" value="0" class="form-control tax_amount" readonly></td>
                    <td><input type="text" name="current_stocks[]" value="0" class="form-control current_stock" readonly></td>
                    <td><input type="text" name="net_amounts[]" value="0" class="form-control net_amount" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                </tr>
            </tbody>
        </table>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="button" id="addRow" class="btn btn-success btn-sm">Add Row</button>
                <button type="submit" class="btn btn-primary btn-sm">Save Invoice</button>
            </div>
        </div>

        <div class="card p-3 mt-4">
            <div class="col-md-12 d-flex flex-column align-items-end">
                <table>
                    <tr class="">
                        <th >Instant Discount</th>
                        <td><input type="text" name="instant_discount" class="form-control instant_discount"></td>
                    </tr>
                    <tr style="margin: 10px 0">
                        <th>Transport Cost</th>
                        <td><input type="text" name="transport_cost" class="form-control transport_cost"></td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td><textarea name="remarks" class="form-control remarks"></textarea></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">

            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Add Row Button
    $('#addRow').click(function () {
        let newRow = `
            <tr class="item-row">
                <td><input type="text" name="sku_codes[]" placeholder="SKU Code" class="form-control sku_code"></td>
                <td><input type="text" name="sku_names[]" placeholder="SKU Name" class="form-control sku_name" readonly></td>
                <td><input type="number" name="quantities[]" value="0" class="form-control quantity"></td>
                <td><input type="text" name="sales_prices[]" value="0" class="form-control sales_price" readonly></td>
                <td><input type="text" name="discounts[]" value="0" class="form-control discount_percent"></td>
                <td><input type="text" name="discount_amounts[]" value="0" class="form-control discount_amount" readonly></td>
                <td><input type="text" name="taxes[]" value="0" class="form-control tax" readonly></td>
                <td><input type="text" name="tax_amounts[]" value="0" class="form-control tax_amount" readonly></td>
                <td><input type="text" name="current_stocks[]" value="0" class="form-control current_stock" readonly></td>
                <td><input type="text" name="net_amounts[]" value="0" class="form-control net_amount" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
            </tr>
        `;
        $('#invoiceItems').append(newRow);
    });

    // Remove Row Button
    $(document).on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        updateTotals(); // Update totals after removing a row
    });

    // 🔎 Customer Search AJAX
    $('.search_customer').on('input', function () {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: "{{ route('searchCustomer') }}",
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    let suggestions = $(".customer_suggestions");
                    let tableBody = $("#customerTable tbody");

                    // Reset Suggestions & Table
                    suggestions.empty().show();
                    tableBody.empty();

                    if (data.length === 0) {
                        suggestions.append(`<li class="list-group-item text-danger">No customer found</li>`);
                    }

                    // Show Customer List in Dropdown
                    data.forEach(customer => {
                        suggestions.append(
                            `<li class="list-group-item customer-item" data-name="${customer.shop_name}"
                             data-customer='${JSON.stringify(customer)}'>
                             ${customer.shop_name} (${customer.phone})
                             </li>`
                        );
                    });

                    // Show Table (Initially Hidden)
                    $("#customerTable").show();
                },
                error: function (xhr) {
                    console.log("Error: ", xhr.responseText);
                }
            });
        } else {
            $(".customer_suggestions").hide();
            $("#customerTable tbody").empty();
        }
    });

    // ✅ Select Customer from List & Show in Table
    $(document).on('click', '.customer-item', function () {
        let customer = $(this).data('customer');

        $('.search_customer').val(customer.shop_name);
        $('.customer_suggestions').hide();

        let newRow = `
            <tr>
                <td>${customer.shop_name}</td>
                <td>${customer.full_name}</td>
                <td>${customer.address}</td>
                <td>${customer.phone}</td>
                <td>${customer.opening_balance}</td>
            </tr>
        `;

        $("#customerTable tbody").append(newRow);
    });

    // 🔎 SKU Search AJAX
    $(document).on('input', '.sku_code', function () {
        let row = $(this).closest('tr');
        let skuCode = row.find('.sku_code').val();

        if (skuCode.length > 1) {
            $.ajax({
                url: '{{ route('getSkuDetails') }}',
                type: 'GET',
                data: { sku_code: skuCode },
                success: function (data) {
                    row.find('.sku_code').val(data.sku_code);
                    row.find('.sku_name').val(data.sku_name);
                    row.find('.sales_price').val(data.sales_price);
                    row.find('.tax').val(data.tax);
                    row.find('.current_stock').val(data.stock);
                },
                error: function () {
                    alert("SKU Not Found!");
                }
            });
        }
    });

    // 💰 Calculate values dynamically
    $(document).on('input', '.quantity, .sales_price, .discount_percent, .tax', function () {
        let row = $(this).closest('tr');
        let quantity = parseFloat(row.find('.quantity').val()) || 0;
        let price = parseFloat(row.find('.sales_price').val()) || 0;
        let discount = parseFloat(row.find('.discount_percent').val()) || 0;
        let tax = parseFloat(row.find('.tax').val()) || 0;

        let subTotal = quantity * price;
        let discountAmount = (subTotal * discount) / 100;
        let taxableAmount = subTotal - discountAmount;
        let taxAmount = (taxableAmount * tax) / 100;
        let netAmount = taxableAmount + taxAmount;

        row.find('.discount_amount').val(discountAmount.toFixed(2));
        row.find('.tax_amount').val(taxAmount.toFixed(2));
        row.find('.net_amount').val(netAmount.toFixed(2));

        // Update Totals
        updateTotals();
    });

    // Function to update totals
    function updateTotals() {
        let totalQuantity = 0;
        let totalAmount = 0;
        let totalTax = 0;
        let totalDiscount = 0;
        let grandTotal = 0;

        $('table.table-bordered tbody tr').each(function () {
            let quantity = parseFloat($(this).find('.quantity').val()) || 0;
            let price = parseFloat($(this).find('.sales_price').val()) || 0;
            let discount = parseFloat($(this).find('.discount_percent').val()) || 0;
            let tax = parseFloat($(this).find('.tax').val()) || 0;

            let subTotal = quantity * price;
            let discountAmount = (subTotal * discount) / 100;
            let taxableAmount = subTotal - discountAmount;
            let taxAmount = (taxableAmount * tax) / 100;
            let netAmount = taxableAmount + taxAmount;

            totalQuantity += quantity;
            totalAmount += subTotal;
            totalTax += taxAmount;
            totalDiscount += discountAmount;
            grandTotal += netAmount;
        });

        $('#totalQuantity').text(totalQuantity);
        $('#totalAmount').text(totalAmount.toFixed(2));
        $('#totalTax').text(totalTax.toFixed(2));
        $('#subTotal').text(totalAmount.toFixed(2));
        $('#totalDiscount').text(totalDiscount.toFixed(2));
        $('#grandTotal').text(grandTotal.toFixed(2));
    }
});
</script>

@endsection
