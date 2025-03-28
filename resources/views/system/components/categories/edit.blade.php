@extends('system.master')

@section('content')
<div class="container">
    <h2>Edit Category</h2>
    
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Sub-Department</label>
            <select name="sku_sub_department_id" class="form-control">
                <option value="">Select Sub-Department</option>
                @foreach($subDepartments as $subDepartment)
                    <option value="{{ $subDepartment->id }}" {{ $category->sku_sub_department_id == $subDepartment->id ? 'selected' : '' }}>{{ $subDepartment->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
