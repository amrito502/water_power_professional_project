@extends('system.master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <h2 style="margin-bottom: 20px;font-size: 24px;font-weight: 500;text-transform: uppercase;">Add Damage/Wastage</h2>

    <form id="damage-form" class="card p-4">
        @csrf
        <div id="damage-items">
            <div class="damage-item">
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="input_multiple d-flex justify-content-between mb-3">
                            <input style="width:14%;" type="text" name="sku_code[]" class="sku_code form-control" placeholder="Enter SKU Code" required />
                            <input style="width:14%;" type="text" name="product_name[]" class="product_name form-control" readonly />
                            <input style="width:14%;" type="number" name="qty[]" class="qty form-control" placeholder="Quantity" required />
                            <input style="width:14%;" type="number" name="cost_price[]" class="cost_price form-control" placeholder="Cost Price" readonly />
                            <input style="width:14%;" type="number" name="additional_cost[]" class="additional_cost form-control" placeholder="Additional Cost" required />
                            <input style="width:14%;" type="text" name="net_amount[]" class="net_amount form-control" readonly />
                            <button style="width:14%;" type="button" class="remove-item btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-start">
                <div class="sub_btn d-flex">
                    <button class="btn btn-success" type="button" id="add-damage-item">Add Another Item</button>
                    <button class="btn btn-info mx-3" type="submit">Add Damage/Wastage</button>
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
            // Add another damage/wastage item row
            document.getElementById('add-damage-item').addEventListener('click', function() {
                const damageItemHTML = `
                    <div class="damage-item d-flex justify-content-between mb-3">
                        <input style="width:14%;" type="text" name="sku_code[]" class="sku_code form-control" placeholder="Enter SKU Code" required />
                        <input style="width:14%;" type="text" name="product_name[]" class="product_name form-control" readonly />
                        <input style="width:14%;" type="number" name="qty[]" class="qty form-control" placeholder="Quantity" required />
                        <input style="width:14%;" type="number" name="cost_price[]" class="cost_price form-control" placeholder="Cost Price" readonly />
                        <input style="width:14%;" type="number" name="additional_cost[]" class="additional_cost form-control" placeholder="Additional Cost" required />
                        <input style="width:14%;" type="text" name="net_amount[]" class="net_amount form-control" readonly />
                        <button style="width:14%;" type="button" class="remove-item btn btn-danger">Remove</button>
                    </div>
                `;
                document.getElementById('damage-items').insertAdjacentHTML('beforeend', damageItemHTML);
            });

            // Remove a damage/wastage item row
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    e.target.closest('.damage-item').remove();
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
                                    const row = e.target.closest('.damage-item');
                                    row.querySelector('.product_name').value = response.data.product.sku_name;
                                    row.querySelector('.cost_price').value = response.data.product.cost_price; // Populate cost_price
                                } else {
                                    alert(response.data.message);
                                }
                            })
                            .catch(error => {
                                console.error('API Error:', error);
                                alert(`API Error: ${error.response?.data?.message || 'Something went wrong'}`);
                            });
                    }
                }
            });

            // Recalculate the net amount and totals on input changes
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('qty') || e.target.classList.contains('cost_price') || e.target.classList.contains('additional_cost')) {
                    const row = e.target.closest('.damage-item');
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

                document.querySelectorAll('.damage-item').forEach(row => {
                    const qty = parseFloat(row.querySelector('.qty').value) || 0;
                    const netAmount = parseFloat(row.querySelector('.net_amount').value) || 0;
                    totalQty += qty;
                    grandTotal += netAmount;
                });

                document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
                document.getElementById('total-qty').textContent = totalQty;
            }

            // Submit form via Axios
            document.getElementById('damage-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                axios.post('/add-damage-wastage', formData, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            alert(response.data.message);
                            location.reload();
                        } else {
                            alert('Failed to add damage/wastage');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Error: ' + (error.response?.data?.errors ? JSON.stringify(error.response.data.errors) : 'Something went wrong'));
                    });
            });
        });
    </script>
@endsection
