@extends('system.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2><a href="{{ route('suppliers.index') }}">Supplier</a>/<a href="{{ route('dashboard') }}">Edit</a></h2>
    </div>
</div>

<div class="">
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="card p-4 mt-4">
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="suppId">Supplier ID</label>
                            <input type="text" name="suppId" id="suppId" class="form-control mt-2"
                                   value="{{ $supplier->suppId }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Supplier Name</label>
                            <input type="text" name="name" id="name" class="form-control mt-2" value="{{ old('name', $supplier->name) }}">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="crType">Credit Type</label>
                            <select name="crType" id="crType" class="form-control mt-2">
                                <option value="">Select Type</option>
                                <option value="credit" {{ $supplier->crType == 'credit' ? 'selected' : '' }}>Credit</option>
                                <option value="consignment" {{ $supplier->crType == 'consignment' ? 'selected' : '' }}>Consignment</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="creditDay" style="display: {{ $supplier->crType == 'credit' ? 'block' : 'none' }};">
                            <label for="creditDay">Credit Days</label>
                            <input type="number" name="creditDay" value="{{ old('creditDay', $supplier->creditDay) }}" id="creditDay" class="form-control mt-2">
                        </div>

                        <div class="form-group mb-3" id="consignmentDay" style="display: {{ $supplier->crType == 'consignment' ? 'block' : 'none' }};">
                            <label for="consignmentDay">Consignment Days</label>
                            <input type="number" name="consignmentDay" value="{{ old('consignmentDay', $supplier->consignmentDay) }}" id="consignmentDay" class="form-control mt-2">
                        </div>

                        <div class="form-group mb-3">
                            <label for="ob">Opening Balance</label>
                            <input type="number" name="ob" id="ob" placeholder="0.00" class="form-control mt-2" value="{{ old('ob', $supplier->ob) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control mt-2" value="{{ old('phone', $supplier->phone) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control mt-2" value="{{ old('email', $supplier->email) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control mt-2">{{ old('address', $supplier->address) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control mt-2" value="{{ old('city', $supplier->city) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control mt-2">
                                <option value="active" {{ $supplier->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $supplier->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    $("#crType").change(function() {
        if ($(this).val() == 'credit') {
            $("#consignmentDay").hide();
            $("#creditDay").show('slow');
        } else if ($(this).val() == 'consignment') {
            $("#creditDay").hide();
            $("#consignmentDay").show('slow');
        }
    });
});
</script>

@endsection
