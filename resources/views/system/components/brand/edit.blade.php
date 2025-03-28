@extends('system.master')

@section('content')
<div class="container">
    <h2>Edit Brand</h2>
    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($brand->image)
                <img src="{{ asset($brand->image) }}" width="100">
            @endif
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label>Rank</label>
            <input type="number" name="rank" class="form-control" value="{{ $brand->rank }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
