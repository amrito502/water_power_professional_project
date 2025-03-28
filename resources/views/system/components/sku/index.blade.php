@extends('system.master')
@section('content')
<div class="">

    <div class="row d-flex">
        <div class="col-md-6">
            <h1 class="mb-4" style="font-weight: 500;font-size: 25px;">SKUs List</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <a href="{{ route('change.sku.price') }}" class="btn btn-info mb-3 mt-1 mx-3">Change Price</a>
            <a href="{{ route('skus.create') }}" class="btn btn-primary mb-3 mt-1 ">Create New SKU</a>
        </div>
    </div>
    <table class="table table-bordered" id="">
        <thead style="background: #6A1B9A;">
            <tr>
                <th class="text-white">SL.</th>
                <th class="text-white">SKU Code</th>
                <th class="text-white">Bar Code</th>
                <th class="text-white">SKU Name</th>
                <th class="text-white">Cost Price</th>
                <th class="text-white">Sell Price</th>
                <th class="text-white">Photo</th>
                <th class="text-white">Status</th>
                <th class="text-white">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skus as $key=>$sku)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $sku->sku_code }}</td>
                    <td>{{ $sku->bar_code }}</td>
                    <td>{{ $sku->sku_name }}</td>
                    <td>{{ $sku->cost_price }}</td>
                    <td>{{ $sku->sell_price }}</td>
                    <td class="d-flex justify-content-center">
                        @if($sku->image)
                            <img src="{{ asset($sku->image) }}" alt="SKU Image" width="50">
                        @endif
                    </td>
                    <td>{{ $sku->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('skus.show', $sku->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('skus.edit', $sku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('skus.destroy', $sku->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</div>

@endsection
