@extends('system.master')

@section('content')
<div class="container">
    <h2>Add SKU Department</h2>
    
    <form action="{{ route('sku_departments.store') }}" method="POST">
        @csrf

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
