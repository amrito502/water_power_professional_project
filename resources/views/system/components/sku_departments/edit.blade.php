@extends('system.master')

@section('content')
<div class="container">
    <h2>Edit SKU Department</h2>
    
    <form action="{{ route('sku_departments.update', $sku_department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $sku_department->name }}" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $sku_department->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $sku_department->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label>Rank</label>
            <input type="number" name="rank" class="form-control" value="{{ $sku_department->rank }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
