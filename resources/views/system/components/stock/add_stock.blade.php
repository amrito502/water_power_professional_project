@extends('system.master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <h2 style="margin-bottom: 20px;font-size: 24px;font-weight: 500;text-transform: uppercase;">Add Stock</h2>

    <form id="stock-form" class="card p-4">
        @csrf
        <div id="stock-items">
            <div class="stock-item">

                <div class="row" style="margin-bottom: 40px;">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="brand_id" style="font-weight: 500;margin-bottom: 8px;">SKU Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option value="">-- Select Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('supplier') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end mb-4" style="margin-top: 30px;">
                        <input style="width: auto;padding: 10px;text-align: center;height: 34px;margin-right: 36px;" type="text" name="po_no" class="po_no" class="form-control"
                            value="PO{{ now()->format('ymdhis') }}" readonly>

                        <input style="width: auto;padding: 10px;text-align: center;height: 34px;" type="text" name="grn_no" class="grn_no" class="form-control"
                            value="GRN{{ now()->format('ymdhis') }}" readonly> <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="input_multiple d-flex justify-content-between mb-3">
                            <input style="width:14%;" type="text" name="sku_code[]" class="sku_code form-control"
                                placeholder="Enter SKU Code" required />
                            <input style="width:14%;" type="text" name="product_name[]" class="product_name form-control"
                                readonly />
                            <input style="width:14%;" type="number" name="qty[]" class="qty form-control"
                                placeholder="Quantity" required />
                            <input style="width:14%;" type="number" name="cost_price[]" class="cost_price form-control"
                                placeholder="Cost Price" required />
                            <input style="width:14%;" type="number" name="additional_cost[]"
                                class="additional_cost form-control" placeholder="Additional Cost" required />
                            <input style="width:14%;" type="text" name="net_amount[]" class="net_amount form-control"
                                readonly />
                            <button style="width:14%;" type="button" class="remove-item btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-start">
                <div class="sub_btn d-flex">
                    <button class="btn btn-success" type="button" id="add-stock-item">Add Another Item</button>
                    <button class="btn btn-info mx-3" type="submit">Add Stock</button>
                </div>
            </div>
        </div>

    </form>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div class="card p-4">
                <div>
                    <p><strong style="font-size: 20px;font-weight: 500;color: #080808;">Grand Total :</strong> <span
                            style="font-size: 20px;font-weight: 500;color: #000000;letter-spacing: 1px;margin-left: 5px;"
                            id="grand-total">0.00 <i class="fa-solid fa-bangladeshi-taka-sign"></i></span></p>
                    <p><strong style="font-size: 20px;font-weight: 500;color: #080808;">Total Quantity :</strong> <span
                            style="font-size: 20px;font-weight: 500;color: #000000;letter-spacing: 1px;margin-left: 5px;"
                            id="total-qty">0 </span></p>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add another stock item row
            document.getElementById('add-stock-item').addEventListener('click', function() {
                const stockItemHTML = `
            <div class="stock-item d-flex justify-content-between mb-3">
                <input style="width:14%;" type="text" name="sku_code[]" class="sku_code form-control" placeholder="Enter SKU Code" required />
                <input style="width:14%;" type="text" name="product_name[]" class="product_name form-control" readonly />
                <input style="width:14%;" type="number" name="qty[]" class="qty form-control" placeholder="Quantity" required />
                <input style="width:14%;" type="number" name="cost_price[]" class="cost_price form-control" placeholder="Cost Price" required />
                <input style="width:14%;" type="number" name="additional_cost[]" class="additional_cost form-control" placeholder="Additional Cost" required />
                <input style="width:14%;" type="text" name="net_amount[]" class="net_amount form-control" readonly />
                <button style="width:14%;" type="button" class="remove-item btn btn-danger">Remove</button>
            </div>
        `;
                document.getElementById('stock-items').insertAdjacentHTML('beforeend', stockItemHTML);
            });

            // Remove a stock item row
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    e.target.closest('.stock-item').remove();
                    calculateTotals();
                }
            });

            // Fetch product details based on SKU code
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('sku_code')) {
                    const skuCode = e.target.value;
                    const index = Array.from(document.querySelectorAll('.sku_code')).indexOf(e.target);

                    if (skuCode) {
                        axios.get(`/get-product/${skuCode}`)
                            .then(response => {
                                if (response.data.success) {
                                    document.querySelectorAll('.product_name')[index].value = response
                                        .data.product.sku_name;
                                } else {
                                    alert(response.data.message);
                                }
                            })
                            .catch(error => {
                                console.error('API Error:', error);
                                alert(
                                    `API Error: ${error.response?.data?.message || 'Something went wrong'}`);
                            });
                    }
                }
            });

            // Recalculate the net amount and totals on input changes
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('qty') || e.target.classList.contains('cost_price') || e
                    .target.classList.contains('additional_cost')) {
                    const row = e.target.closest('.stock-item');
                    const qty = parseFloat(row.querySelector('.qty').value) || 0;
                    const costPrice = parseFloat(row.querySelector('.cost_price').value) || 0;
                    const additionalCost = parseFloat(row.querySelector('.additional_cost').value) || 0;
                    const netAmount = (qty * costPrice) + additionalCost;
                    row.querySelector('.net_amount').value = netAmount.toFixed(2);
                    calculateTotals();
                }
            });

            // Calculate grand total and total quantity
            function calculateTotals() {
                let grandTotal = 0;
                let totalQty = 0;

                document.querySelectorAll('.stock-item').forEach(row => {
                    const qty = parseFloat(row.querySelector('.qty').value) || 0;
                    const netAmount = parseFloat(row.querySelector('.net_amount').value) || 0;
                    totalQty += qty;
                    grandTotal += netAmount;
                });

                document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
                document.getElementById('total-qty').textContent = totalQty;
            }

            // Submit form via Axios
            document.getElementById('stock-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                axios.post('/add-stock', formData, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            alert(response.data.message);
                            location.reload();
                        } else {
                            alert('Failed to add stock');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Error: ' + (error.response?.data?.errors ? JSON.stringify(error.response
                            .data.errors) : 'Something went wrong'));
                    });
            });
        });
    </script>
@endsection
