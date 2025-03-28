@extends('system.master')

@section('content')
    <h2>Edit Tax</h2>
    <div class="card p-4">
        <form class="form" action="{{ route('taxes.update', $tax->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Tax Rate % </label>
            <input class="form-control mt-3" type="number" name="tax_rate" value="{{ old('tax_rate', $tax->tax_rate) }}" required>
            @error('tax_rate') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="tax_type">Tax Type</label>
            <select class="form-control mt-3" name="tax_type">
                <option value="">Select Tax Type</option>
                <option value="0" {{ old('tax_type', $tax->tax_type) == '0' ? 'selected' : '' }}>VAT</option>
                <option value="1" {{ old('tax_type', $tax->tax_type) == '1' ? 'selected' : '' }}>Service</option>
            </select>
            @error('tax_type') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="status">Status</label>
            <select class="form-control mt-3" name="status">
                <option value="">Select Status</option>
                <option value="1" {{ old('status', $tax->status) == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $tax->status) == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror

            <button class="btn btn-info mt-3" type="submit">Update</button>
            <a href="{{ route('taxes.index') }}" class="btn btn-danger mt-3">Back</a>
        </form>
    </div>
@endsection
