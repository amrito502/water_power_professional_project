@extends('system.master')

@section('content')
    <div class="containers">
        <h2 class="mb-4">Customers List</h2>

        <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add New Customer</a>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Code</th>
                            <th>Shop Name</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->customer_code }}</td>
                                <td>{{ $customer->shop_name }}</td>
                                <td>{{ $customer->full_name }}</td>
                                <td>{{ $customer->gender }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <span class="badge {{ $customer->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $customer->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
