@extends('system.master')

@section('content')
    <h1>Edit Employee</h1>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="employee_id">Employee ID</label>
            <input type="text" name="employee_id" value="{{ $employee->employee_id }}" required>
        </div>

        <div>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="{{ $employee->first_name }}" required>
        </div>

        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="{{ $employee->last_name }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $employee->email }}" required>
        </div>

        <div>
            <label for="shift_id">Shift</label>
            <select name="shift_id" required>
                @foreach($shifts as $shift)
                    <option value="{{ $shift->id }}" {{ $employee->shift_id == $shift->id ? 'selected' : '' }}>{{ $shift->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="department_id">Department</label>
            <select name="department_id" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="designation_id">Designation</label>
            <select name="designation_id" required>
                @foreach($designations as $designation)
                    <option value="{{ $designation->id }}" {{ $employee->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="role_id">Role</label>
            <select name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $employee->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update Employee</button>
    </form>
@endsection
