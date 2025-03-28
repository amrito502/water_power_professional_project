@extends('system.master')

@section('content')
<div class="container">
    <h2>SKU Sub-Departments</h2>

    <a href="{{ route('sku_sub_departments.create') }}" class="btn btn-success mb-3">Add New</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Department</th>
                <th>Name</th>
                <th>Status</th>
                <th>Rank</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subDepartments as $subDepartment)
                <tr>
                    <td>{{ $subDepartment->id }}</td>
                    <td>{{ $subDepartment->department->name ?? 'N/A' }}</td>
                    <td>{{ $subDepartment->name }}</td>
                    <td>{{ $subDepartment->status ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $subDepartment->rank }}</td>
                    <td>
                        <a href="{{ route('sku_sub_departments.edit', $subDepartment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('sku_sub_departments.destroy', $subDepartment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
