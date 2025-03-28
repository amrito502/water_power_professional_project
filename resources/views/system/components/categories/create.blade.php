@extends('system.master')


@section('content')
<div class="container">
    <h2>Add Category</h2>
    
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Sub-Department</label>
            <select name="sku_sub_department_id" class="form-control">
                <option value="">Select Sub-Department</option>
                @foreach($subDepartments as $subDepartment)
                    <option value="{{ $subDepartment->id }}">{{ $subDepartment->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label>Rank</label>
            <input type="number" name="rank" class="form-control" value="5">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
