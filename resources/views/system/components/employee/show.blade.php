@extends('system.master')

@section('content')
    <h1 class="mb-3">Employee Details</h1>

   <div class="row">
    <div class="col-md-6">
        <div class="employee-details">
            <table class="table table-bordered">
                <tr>
                    <th>Employee ID</th>
                    <td>{{ $employee->employee_id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $employee->gender }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ $employee->date_of_birth }}</td>
                </tr>
                <tr>
                    <th>Nationality</th>
                    <td>{{ $employee->nationality }}</td>
                </tr>
                <tr>
                    <th>Marital Status</th>
                    <td>{{ $employee->marital_status }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{ $employee->phone_number }}</td>
                </tr>
                <tr>
                    <th>Emergency Contact Number</th>
                    <td>{{ $employee->emergency_contact_number }}</td>
                </tr>
                <tr>
                    <th>Job Title</th>
                    <td>{{ $employee->job_title }}</td>
                </tr>
                <tr>
                    <th>Date of Joining</th>
                    <td>{{ $employee->date_of_joining }}</td>
                </tr>
                <tr>
                    <th>Work Location</th>
                    <td>{{ $employee->work_location }}</td>
                </tr>
                <tr>
                    <th>Basic Salary</th>
                    <td>{{ $employee->basic_salary }}</td>
                </tr>
                <tr>
                    <th>Bank Name</th>
                    <td>{{ $employee->bank_name }}</td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td>{{ $employee->account_number }}</td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td>{{ $employee->ifsc_code }}</td>
                </tr>
                <tr>
                    <th>Tax ID</th>
                    <td>{{ $employee->tax_id }}</td>
                </tr>
                <tr>
                    <th>Shift</th>
                    <td>{{ $employee->shift->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td>{{ $employee->designation->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $employee->role->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $employee->status == 1 ? 'Active' : 'Inactive' }}</td>
                </tr>
            </table>
        </div>
    </div>
   </div>

    <a class="btn btn-info mt-4" href="{{ route('employees.index') }}">Back to Employee List</a>
@endsection
