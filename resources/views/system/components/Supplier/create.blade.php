@extends('system.master')


@section('content')


<div class="row">
    <div class="col-lg-12">
        <h2><a href="{{ route('suppliers.index') }}">Supplier</a></h2>
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
                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="suppId">Supplier ID</label>
                            <input type="text" name="suppId" id="suppId" class="form-control mt-2"
                                   value="SN{{ now()->format('ymdhis') }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Supplier Name</label>
                            <input type="text" name="name" id="name" class="form-control mt-2">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="crType">Credit Type</label>
                            <select name="crType" id="crType" class="form-control mt-2">
                                <option value="">Select Type</option>
                                <option value="credit">Credit</option>
                                <option value="consignment">Consignment</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="creditDay" style="display: none;">
                            <label for="creditDay">Credit Days</label>
                            <input type="number" name="creditDay" value="0" id="creditDay" class="form-control mt-2">
                        </div>

                        <div class="form-group mb-3" id="consignmentDay" style="display: none;">
                            <label for="consignmentDay">Consignment Days</label>
                            <input type="number" name="consignmentDay" value="0" id="consignmentDay" class="form-control mt-2">
                        </div>

                        <div class="form-group mb-3">
                            <label for="ob">Opening Balance</label>
                            <input type="number" name="ob" id="ob" placeholder="0.00" class="form-control mt-2">
                        </div>


                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control mt-2">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control mt-2">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control mt-2"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control mt-2">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control mt-2">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
