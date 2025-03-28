@extends('system.master')

@section('content')
<div class="container">
    <h2>Edit SKU Sub-Department</h2>
    
    <form action="{{ route('sku_sub_departments.update', $sku_sub_department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Department</label>
            <select name="sku_department_id" class="form-control">
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $sku_sub_department->sku_department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $sku_sub_department->name }}" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $sku_sub_department->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $sku_sub_department->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
