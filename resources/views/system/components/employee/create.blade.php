@extends('system.master')

@section('style')
    <style>
        .card, table {
            font-family: "Noto Sans", sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12">
            <div class="card px-3 py-4">
                <h2 style="font-weight: 700; color: #383535; margin-bottom: 15px;">Add Employee</h2>
                <div class="url_page">
                    <p style="font-size: 15px; font-weight: 400; margin-bottom: 0px;">
                        <a href="{{ url('/') }}">Home</a> / HR Module / Add Employee
                    </p>
                    <a class="btn btn-info" href="{{ route('employees.index') }}" style="float: right">
                        View Employees
                    </a>
                </div>
            </div>
            <div class="card p-5">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="employee_id">Employee ID</label>
                        <input type="text" name="employee_id" id="employee_id" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="nationality">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="marital_status">Marital Status</label>
                        <select name="marital_status" id="marital_status" class="form-control">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="emergency_contact_number">Emergency Contact Number</label>
                        <input type="text" name="emergency_contact_number" id="emergency_contact_number" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="job_title">Job Title</label>
                        <input type="text" name="job_title" id="job_title" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="date_of_joining">Date of Joining</label>
                        <input type="date" name="date_of_joining" id="date_of_joining" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="work_location">Work Location</label>
                        <input type="text" name="work_location" id="work_location" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="basic_salary">Basic Salary</label>
                        <input type="number" step="0.01" name="basic_salary" id="basic_salary" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="bank_name">Bank Name</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="account_number">Account Number</label>
                        <input type="text" name="account_number" id="account_number" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="ifsc_code">IFSC Code</label>
                        <input type="text" name="ifsc_code" id="ifsc_code" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="tax_id">Tax ID</label>
                        <input type="text" name="tax_id" id="tax_id" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="shift_id">Shift</label>
                        <select name="shift_id" id="shift_id" class="form-control">
                            @foreach($shifts as $shift)
                                <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="department_id">Department</label>
                        <select name="department_id" id="department_id" class="form-control">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="designation_id">Designation</label>
                        <select name="designation_id" id="designation_id" class="form-control">
                            @foreach($designations as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info mt-4">
                            Create Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection