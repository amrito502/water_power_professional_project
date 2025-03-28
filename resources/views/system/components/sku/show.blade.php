@extends('system.master')

@section('content')
<div class="container">
    <h1>SKU Details</h1>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>SKU Code</th>
                <td>{{ $sku->sku_code }}</td>
            </tr>
            <tr>
                <th>Bar Code</th>
                <td>{{ $sku->bar_code }}</td>
            </tr>
            <tr>
                <th>SKU Name</th>
                <td>{{ $sku->sku_name }}</td>
            </tr>
            <tr>
                <th>Cost Price</th>
                <td>{{ $sku->cost_price }}</td>
            </tr>
            <tr>
                <th>Sell Price</th>
                <td>{{ $sku->sell_price }}</td>
            </tr>
            <tr>
                <th>Brand</th>
                <td>{{ $sku->brand->name }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $sku->department->name }}</td>
            </tr>
            <tr>
                <th>Sub Department</th>
                <td>{{ $sku->subDepartment->name }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $sku->category->name }}</td>
            </tr>
            <tr>
                <th>Supplier</th>
                <td>{{ $sku->supplier->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Tax %</th>
                <td>{{ $sku->tax->tax_rate }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $sku->status == 1 ? 'Active' : 'Inactive' }}</td>
            </tr>
            @if($sku->image)
            <tr>
                <th>Image</th>
                <td>
                    <img src="{{ asset($sku->image) }}" alt="SKU Image" width="150">
                </td>
            </tr>
            @endif
        </tbody>
    </table>

    <a href="{{ route('skus.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
