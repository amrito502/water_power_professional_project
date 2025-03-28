@extends('system.master')

@section('content')
    <h2>Taxes</h2>
    <a class="btn btn-success my-3" href="{{ route('taxes.create') }}">Create Tax</a>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tax Rate %</th>
                <th>Tax Type</th>
                <th>Rank</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxes as $tax)
                <tr>
                    <td>{{ $tax->id }}</td>
                    <td>{{ $tax->tax_rate }}</td>
                    <td>{{ $tax->tax_type == 0 ? 'VAT' : 'Service' }}</td>
                    <td>{{ $tax->rank }}</td>
                    <td><button class="btn btn-sm btn-success">{{ $tax->status == 1 ? 'Active' : 'Inactive'}}</button></td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('taxes.show', $tax) }}">View</a>
                        <a class="btn btn-sm btn-warning" href="{{ route('taxes.edit', $tax) }}">Edit</a>
                        <form action="{{ route('taxes.destroy', $tax) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
