@extends('system.master')

@section('content')
<div class="containe mt-4">
    <h2 class="mb-3 text-primary">Edit SKU</h2>

    <!-- SKU Search Form -->
    <div class="card shadow-sm p-4 mb-4">
        <h5 class="card-title">Search SKU</h5>
        <form id="skuSearchForm">
            <div class="form-group">
                <label for="sku_code">Enter SKU Code:</label>
                <input type="text" id="sku_code" name="sku_code" class="form-control mt-2" placeholder="Enter SKU Code" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-search"></i> Search
            </button>
            <a href="{{ route('skus.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </form>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- SKU Details (displayed after search) -->
    <div id="skuDetails" class="mt-4"></div>
        </div>
        <div class="col-md-4">
<!-- Price Update Form (Hidden Initially) -->
<div id="priceUpdateForm" class="card shadow-sm p-4 mt-4" style="display:none;">
    <h5 class="card-title">Update SKU Price</h5>
    <form id="updatePriceForm" data-sku-id="" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cost_price">Cost Price:</label>
            <input type="number" id="cost_price" name="cost_price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="sell_price">Sell Price:</label>
            <input type="number" id="sell_price" name="sell_price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">
            <i class="fas fa-save"></i> Update Price
        </button>
        
    </form>
</div>
        </div>
    </div>




</div>

<!-- Axios for Dynamic Search and Update -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Handle SKU search with Axios
    document.getElementById('skuSearchForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let sku_code = document.getElementById('sku_code').value;

        axios.post('/sku/search', { sku_code: sku_code })
            .then(function(response) {
                const sku = response.data.sku;

                document.getElementById('skuDetails').innerHTML = `
                    <div class="card shadow-sm p-4">
                        <h5 class="card-title text-success">SKU Found</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>SKU Code</th>
                                    <td>${sku.sku_code}</td>
                                </tr>
                                <tr>
                                    <th>Cost Price</th>
                                    <td>${sku.cost_price}</td>
                                </tr>
                                <tr>
                                    <th>Sell Price</th>
                                    <td>${sku.sell_price}</td>
                                </tr>
                                <tr>
                                    <th>SKU ID</th>
                                    <td>${sku.id}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;

                // Show the price update form
                document.getElementById('priceUpdateForm').style.display = 'block';

                // Pre-fill the fields with the current data
                document.getElementById('cost_price').value = sku.cost_price;
                document.getElementById('sell_price').value = sku.sell_price;

                // Store the SKU ID for later use
                document.getElementById('updatePriceForm').dataset.skuId = sku.id;
            })
            .catch(function(error) {
                let errorMessage = `<p class="alert alert-danger">An error occurred. Please try again.</p>`;
                if (error.response && error.response.status === 404) {
                    errorMessage = `<p class="alert alert-warning">SKU not found!</p>`;
                }
                document.getElementById('skuDetails').innerHTML = errorMessage;
            });
    });

    // Handle price update
    document.getElementById('updatePriceForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let skuId = this.getAttribute('data-sku-id');
        let cost_price = document.getElementById('cost_price').value;
        let sell_price = document.getElementById('sell_price').value;

        axios.post('/sku/update-price', {
            sku_id: skuId,
            cost_price: cost_price,
            sell_price: sell_price,
            branch_id: 1
        })
        .then(function(response) {
            alert(response.data.message);
            location.reload();
        })
        .catch(function(error) {
            alert('Error: ' + (error.response.data.message || 'Something went wrong.'));
        });
    });

</script>
@endsection
