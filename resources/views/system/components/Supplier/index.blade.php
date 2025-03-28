@extends('system.master')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Supplier Manage</h2> <a class="btn btn-primary mt-3" href="{{ route('suppliers.create') }}">Add Supplier</a>
            @if (session('success'))
                <div class="alert text-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered mt-4">
                <thead class="table-secondary">
                    <tr>
                        <th>SL.</th>
                        <th>Supplier ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Credit Type</th>
                        <th>Credit Day</th>
                        <th>Consignment Day</th>
                        <th>Opening Balance</th>
                        <th>rank</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $key => $supplier)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $supplier->suppId }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->crType }}</td>
                            <td>{{ $supplier->creditDay }}</td>
                            <td>{{ $supplier->consignmentDay }}</td>
                            <td>{{ $supplier->ob }}</td>
                            <td>{{ $supplier->rank }}</td>
                            <td>{{ $supplier->status }}</td>
                            <td>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this shift?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
