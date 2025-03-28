@extends('system.master')

@section('content')
<div class="containers">
    <h2 class="mb-4">Stock Requests</h2>
    <a href="{{ route('stock-requests.show') }}" class="btn btn-info mb-3">Update stock</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="approve-form" action="{{ route('stock_requests.approve') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success mb-3" id="bulk-approve-btn">Approve Selected</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>SL No.</th>
                    <th>GRN No.</th>
                    <th>GRN Date</th>
                    <th>PO No.</th>
                    <th>Supplier</th>
                    <th>Cost Price</th>
                    <th>GRN Quantity</th>
                    <th>GRN Amount</th>
                    <th>GRN Percent</th>
                    <th>GRN Discount</th>
                    <th>GRN Grand Total</th>
                    <th>Status</th>
                    <th>Approve</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockRequests as $key=>$stockRequest)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $stockRequest->id }}"></td>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $stockRequest->grn_no }}</td>
                    <td>{{ $stockRequest->grn_date }}</td>
                    <td>{{ $stockRequest->po_no }}</td>


                    <td>{{ $stockRequest->supplier->name ?? 'N/A' }}</td>

                    <td>{{ $stockRequest->sku->cost_price }}</td>
                    <td>{{ $stockRequest->total_qty }}</td>
                    <td>{{ number_format($stockRequest->total_price, 2) }}</td>
                    <td>{{ number_format($stockRequest->disc_percent, 2) }}</td>
                    <td>{{ number_format($stockRequest->total_discount, 2) }}</td>
                    <td>{{ number_format($stockRequest->grand_total, 2) }}</td>
                    <td>
                        @if($stockRequest->status == 1)
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if($stockRequest->status != 1)
                        <form action="{{ route('stock_requests.approve') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="ids[]" value="{{ $stockRequest->id }}">
                            <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@endsection
