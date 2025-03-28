@extends('system.master')

@section('content')
    <div class="container">
        <h2 class="mb-4">Customer Details</h2>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Customer Code</th>
                            <td>{{ $customer->customer_code }}</td>
                        </tr>

                        <tr>
                            <th scope="row">User</th>
                            <td>{{ $customer->user->name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Shop Name</th>
                            <td>{{ $customer->shop_name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Full Name</th>
                            <td>{{ $customer->full_name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Gender</th>
                            <td>{{ $customer->gender }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Address</th>
                            <td>{{ $customer->address }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Postal Code</th>
                            <td>{{ $customer->postal_code }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Thana</th>
                            <td>{{ $customer->thana }}</td>
                        </tr>

                        <tr>
                            <th scope="row">City</th>
                            <td>{{ $customer->city }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Phone</th>
                            <td>{{ $customer->phone }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $customer->email }}</td>
                        </tr>

                        <tr>
                            <th scope="row">V Card</th>
                            <td>{{ $customer->v_card }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Date of Birth</th>
                            <td>{{ $customer->date_of_birth }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Opening Balance</th>
                            <td>{{ number_format($customer->opening_balance, 2) }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Status</th>
                            <td>{{ $customer->status ? 'Active' : 'Inactive' }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Created By</th>
                            <td>{{ $customer->createdBy }}</td>
                        </tr>
                    </tbody>
                </table>

                <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Back to Customer List</a>
            </div>
        </div>
    </div>
@endsection
