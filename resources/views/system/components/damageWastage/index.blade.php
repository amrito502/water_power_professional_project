@extends('system.master')
@section('content')
    <div class="row">
        <h1>Add Damage/Wastage</h1>

        <div class="row" style="margin-bottom: 40px;">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="dw_no" style="font-weight: 500;margin-bottom: 8px;">Damage/Wastage No</label>
                    <input type="text" name="dw_no" class="form-control" value="DW{{ now()->format('ymdhis') }}" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="type" style="font-weight: 500;margin-bottom: 8px;">Type</label>
                    <select name="type" class="form-control">
                        <option value="1">Damage</option>
                        <option value="2">Wastage</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" style="margin-bottom: 40px;">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="branch_id" style="font-weight: 500;margin-bottom: 8px;">Branch</label>
                    <select name="branch_id" class="form-control">
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="dam_date" style="font-weight: 500;margin-bottom: 8px;">Damage/Wastage Date</label>
                    <input type="date" name="dam_date" class="form-control" value="{{ now()->toDateString() }}" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SKU Code</th>
                            <th>SKU Name</th>
                            <th>Quantity</th>
                            <th>Current Stock</th>
                            <th>Cost Price</th>
                            <th>Net Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control sku_code" placeholder="sku"></td>
                            <td><input type="text" class="form-control sku_name" placeholder="name"></td>
                            <td><input type="number" class="form-control quantity" value="1"></td>
                            <td><input type="number" class="form-control current_stock" value="1"></td>
                            <td><input type="number" class="form-control cost_price" value="0.00"></td>
                            <td><input type="number" class="form-control net_amount" value="0" readonly></td>
                            <td><input type="hidden" class="sku_id" value=""></td>
                            <td><button class="btn btn-danger remove-row">Remove</button></td>
                        </tr>
                    </tbody>
                </table>

                <button id="addRow" class="btn btn-success">Add Row</button>
                <button id="saveInventory" class="btn btn-primary">Add Damage/Wastage</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        // Add a new row to the table
        $("#addRow").on("click", function() {
            let newRow = `<tr>
                    <td><input type="text" class="form-control sku_code" placeholder="sku"></td>
                    <td><input type="text" class="form-control sku_name" placeholder="name"></td>
                    <td><input type="number" class="form-control quantity" value="1"></td>
                    <td><input type="number" class="form-control current_stock" value="0"></td>
                    <td><input type="number" class="form-control cost_price" value="0.00"></td>
                    <td><input type="number" class="form-control net_amount" value="0" readonly></td>
                    <td><input type="hidden" class="sku_id" value=""></td>
                    <td><button class="btn btn-danger remove-row">Remove</button></td>
                </tr>`;
            $("tbody").append(newRow);
        });

        // Remove a row from the table
        $(document).on("click", ".remove-row", function() {
            $(this).closest("tr").remove();
        });

        // Handle SKU input to fetch product details
        $(document).on('keyup', '.sku_code', function() {
            let sku = $(this).val();
            let row = $(this).closest('tr');

            if (sku) {
                $.ajax({
                    url: '/get-product',
                    type: 'GET',
                    data: { sku_code: sku },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        if (response.success) {
                            row.find('.sku_name').val(response.sku.sku_name);
                            row.find('.cost_price').val(response.sku.cost_price);
                            row.find('.sku_id').val(response.sku.id);
                            calculateRow(row);
                        } else {
                            row.find('.sku_name').val('');
                            row.find('.cost_price').val(0);
                            row.find('.sku_id').val('');
                            row.find('.net_amount').val(0);
                        }
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            } else {
                row.find('.sku_name').val('');
                row.find('.cost_price').val(0);
                row.find('.sku_id').val('');
                row.find('.net_amount').val(0);
            }
        });

        // Calculate the net amount based on quantity and cost price
        $(document).on('input', '.quantity, .cost_price', function() {
            let row = $(this).closest('tr');
            calculateRow(row);
        });

        // Function to calculate net amount
        function calculateRow(row) {
            let quantity = parseFloat(row.find('.quantity').val()) || 0;
            let cost_price = parseFloat(row.find('.cost_price').val()) || 0;
            let netAmount = quantity * cost_price;
            row.find('.net_amount').val(netAmount.toFixed(2));
        }

        // Save the damage/wastage data
        $("#saveInventory").on("click", function() {
            let data = [];
            let dw_no = $("input[name='dw_no']").val();
            let type = $("select[name='type']").val();
            let branch_id = $("select[name='branch_id']").val();
            let dam_date = $("input[name='dam_date']").val();

            $("tbody tr").each(function() {
                let row = $(this);
                let rowData = {
                    sku_code: row.find(".sku_code").val(),
                    sku_name: row.find(".sku_name").val(),
                    qty: row.find(".quantity").val(),
                    current_stock: row.find(".current_stock").val(),
                    cost_price: row.find(".cost_price").val(),
                    net_amount: row.find(".net_amount").val(),
                    sku_id: row.find(".sku_id").val(),
                };
                data.push(rowData);
            });

            $.ajax({
                url: "/damagewastages",
                type: "POST",
                data: JSON.stringify({
                    dw_no: dw_no,
                    type: type,
                    branch_id: branch_id,
                    dam_date: dam_date,
                    data: data
                }),
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr) {
                    alert("Error: " + xhr.responseJSON.message);
                }
            });
        });
    </script>
@endsection
