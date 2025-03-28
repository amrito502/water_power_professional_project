@extends('system.master')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Customer</h2>
        <div class="card">
            <form class="p-4" action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="customer_code" class="form-label">Customer Code</label>
                        <input type="text" name="customer_code" class="form-control" id="customer_code" value="{{ $customer->customer_code }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-control" id="user_id">
                            <option value="">Select User</option>
                            @foreach(App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ $customer->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="shop_name" class="form-label">Shop Name</label>
                        <input type="text" name="shop_name" class="form-control" id="shop_name" value="{{ $customer->shop_name }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="full_name" value="{{ $customer->full_name }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="Male" {{ $customer->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $customer->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{ $customer->address }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" id="postal_code" value="{{ $customer->postal_code }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="thana" class="form-label">Thana</label>
                        <input type="text" name="thana" class="form-control" id="thana" value="{{ $customer->thana }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" id="city" value="{{ $customer->city }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $customer->phone }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $customer->email }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="v_card" class="form-label">V Card</label>
                        <input type="text" name="v_card" class="form-control" id="v_card" value="{{ $customer->v_card }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{ $customer->date_of_birth }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="opening_balance" class="form-label">Opening Balance</label>
                        <input type="number" step="0.01" name="opening_balance" class="form-control" id="opening_balance" value="{{ $customer->opening_balance }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="created_by" class="form-label">Created By</label>
                        <select name="created_by" class="form-control" id="created_by">
                            @foreach(App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ $customer->created_by == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3">Update Customer</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>
    </div>
@endsection
