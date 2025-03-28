@extends('system.master')

@section('style')
    <style>
        .card, table {
            font-family: "Noto Sans", sans-serif;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12">
            <div class="card px-3 py-4">
                <h2 style="font-weight: 700; color: #383535; margin-bottom: 15px;">Employees List</h2>
                {{-- <a class="btn btn-info" href="{{ route('employees.create') }}" style="float: right">
                    Add Employee
                </a>
                <a class="btn btn-success" href="{{ route('export.employees') }}">Export Employee</a> --}}
            </div>

            <div class="card p-3">
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Date of Joining</th>
                                <th>Shift</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Role</th>
                                <th>Profile Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    
                                    <td>{{ $employee->phone_number }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->date_of_joining }}</td>
                      
                                    <td>{{ $employee->shift->shift_name ?? 'N/A' }}</td>
                                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                                    <td>{{ $employee->designation->name ?? 'N/A' }}</td>
                                    <td>{{ $employee->role->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($employee->image)
                                            <img src="{{ asset( $employee->image) }}" alt="Profile Image" width="50">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $employee->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td style="display: flex;padding: 10px 0;width: 172px;" class="px-2">
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm mx-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                {{-- <div class="d-flex justify-content-center mt-4">
                    {{ $employees->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection