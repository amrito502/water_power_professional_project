@extends('system.master')

@section('content')
    <div class="container">
        <h2>Add Shareholder</h2>
        <div class="card p-4">
            <form action="{{ route('shareholders.store') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- Gender Field -->
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Address Line Field -->
                <div class="form-group">
                    <label for="addressline">Address Line</label>
                    <input type="text" name="addressline" id="addressline" class="form-control" value="{{ old('addressline') }}">
                </div>

                <!-- City Field -->
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>

                <!-- Share Percent Field -->
                <div class="form-group">
                    <label for="sharePercent">Share Percent (%)</label>
                    <input type="number" name="sharePercent" id="sharePercent" class="form-control" value="{{ old('sharePercent') }}" max="100" min="0">
                </div>

                <!-- Opening Balance Field -->
                <div class="form-group">
                    <label for="opening_balance">Opening Balance</label>
                    <input type="number" name="opening_balance" id="opening_balance" class="form-control" value="{{ old('opening_balance', 0) }}" step="0.01">
                </div>

                <!-- Status Field -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Hidden Created By (Logged-in User) -->
                <input type="hidden" name="created_by" value="{{ auth()->id() }}">

                <button type="submit" class="btn btn-success mt-3">Add Shareholder</button>
                <a href="{{ route('shareholders.index') }}" class="btn btn-danger mt-3">Back</a>
            </form>
        </div>
    </div>
@endsection
