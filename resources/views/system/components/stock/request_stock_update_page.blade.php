@extends('system.master')

@section('content')
<div class="containers">
    <h2>Stock Requests</h2>

    <!-- GRN Number Input -->
    <div class="mb-3">
        <label for="grn_no" class="form-label">Enter GRN No:</label>
        <input type="text" id="grn_no" class="form-control" placeholder="Enter GRN No">
    </div>

    <!-- Stock Requests Table -->
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>SKU Code</th>
                <th>SKU Name</th>
                <th>Quantity</th>
                <th>Cost Price</th>
                <th>Sell Price</th>
                <th>Total Qty</th>
                <th>Disc %</th>
                <th>Disc Amount</th>
                <th>Total Amount</th>
                <th>Total Discount</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody id="stock_requests_body"></tbody>
    </table>

    <!-- Update Button -->
    <button class="btn btn-primary" id="update_stock_requests">Update</button>
</div>

<!-- Include jQuery and Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
$(document).ready(function () {
    // Fetch stock requests by GRN number
    $('#grn_no').on('input', function () {
        let grn_no = $(this).val();
        if (grn_no.length > 0) {
            axios.get(`/stock-requests/get/${grn_no}`)
                .then(response => {
                    let tableBody = $('#stock_requests_body');
                    tableBody.empty();

                    response.data.forEach((stock, index) => {
                        let row = `<tr>
                            <td>${index + 1}</td>
                            <td>${stock.sku.sku_code}</td>
                            <td>${stock.sku.sku_name}</td>
                            <td>${stock.total_qty}</td>
                            <td>${stock.sku.cost_price}</td>
                            <td>${stock.sku.sell_price}</td>
                            <td><input type="number" class="form-control total_qty" data-id="${stock.id}" value="${stock.total_qty ?? 0}"></td>
                            <td><input type="number" class="form-control disc_percent" data-id="${stock.id}" value="${stock.disc_percent ?? 0}"></td>
                            <td class="disc_amount">0.00</td>
                            <td class="total_amount">0.00</td>
                            <td class="total_discount">0.00</td>
                            <td class="grand_total">0.00</td>
                        </tr>`;
                        tableBody.append(row);
                    });

                    addEventListeners();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching stock requests.');
                });
        }
    });

    // Add event listeners for dynamic calculations
    function addEventListeners() {
        $('.total_qty, .disc_percent').on('input', function () {
            let row = $(this).closest('tr');
            let totalQty = parseFloat(row.find('.total_qty').val()) || 0;
            let discPercent = parseFloat(row.find('.disc_percent').val()) || 0;
            let costPrice = parseFloat(row.find('td:nth-child(5)').text()) || 0;

            let totalAmount = totalQty * costPrice;
            let discAmount = (discPercent / 100) * totalAmount;
            let grandTotal = totalAmount - discAmount;

            row.find('.disc_amount').text(discAmount.toFixed(2));
            row.find('.total_amount').text(totalAmount.toFixed(2));
            row.find('.total_discount').text(discAmount.toFixed(2));
            row.find('.grand_total').text(grandTotal.toFixed(2));
        });
    }

    // Update stock requests using Axios
    $('#update_stock_requests').on('click', function () {
        let stockRequests = [];

        $('.total_qty').each(function () {
            let id = $(this).data('id');
            let totalQty = parseFloat($(this).val()) || 0;
            let discPercent = parseFloat($(`.disc_percent[data-id="${id}"]`).val()) || 0;

            stockRequests.push({
                id: id,
                total_qty: totalQty,
                disc_percent: discPercent
            });
        });

        axios.post('/stock-requests/update', { stock_requests: stockRequests }, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            alert(response.data.message); // Show success message
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating stock requests.');
        });
    });
});
</script>
@endsection
