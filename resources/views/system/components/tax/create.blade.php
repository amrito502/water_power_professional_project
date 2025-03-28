@extends('system.master')

@section('content')
    <h2>Create Tax</h2>
  <div class="card p-4">
    <form class="form" action="{{ route('taxes.store') }}" method="POST">
        @csrf
        <label>Tax Rate % </label>
        <input class="form-control mt-3" type="number" name="tax_rate" required>
        
        <label for="tax_type">Tax Type</label>
        <select class="form-control mt-3" name="tax_type" class="form-control">
            <option value="">Select Tax Type</option>
            <option value="0">VAT</option>
            <option value="1">Service</option>
        </select>
        
        <label for="status">status</label>
        <select class="form-control mt-3" name="status" class="form-control">
            <option value="">Select status</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
        
        {{-- <label>Rank:</label>
        <input type="number" name="rank" value="5"> --}}

        <button class="btn btn-info mt-3" type="submit">Save</button>
        <a href="{{ route('taxes.index') }}" class="btn btn-danger mt-3" type="submit">Back</a>
    </form>
  </div>
@endsection