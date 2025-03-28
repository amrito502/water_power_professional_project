@extends('system.master')

@section('style')
    <style>
        .card,
        table {
            font-family: "Noto Sans", sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12">
            <div class="card px-3 py-4">
                <h2 style="font-weight: 700;color: #383535;margin-bottom: 15px;">Add Zone</h2>
                <div class="url_page">
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;">
                        <a href="{{ url('/') }}">Home</a> / Settings / Manage Company / Add Zone
                    </p>
                    <a href="{{ route('zones.index') }}" 
                       style="display: inline-block;float: right;width: 137px;text-decoration: none;font-size: 16px;font-weight: 500;border: 1px solid #18A689;color: #18A689;padding: 10px 15px;border-radius: 6px;">
                        Zone List
                    </a>
                </div>
            </div>
            <div class="card p-5">
                <form action="{{ route('zones.store') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Branch select input -->
                    <div class="form-group mb-3">
                        <label for="branch_id" style="font-size: 16px;font-weight: 500;">Branch</label>
                        <select name="branch_id" id="branch_id" class="form-control py-2 mt-3">
                            <option value="">-- Select Branch --</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name" style="font-size: 16px;font-weight: 500;">Zone Name</label>
                        <input type="text" name="name" id="name" placeholder="Zone Name" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="addressline" style="font-size: 16px;font-weight: 500;">Address Line</label>
                        <input type="text" name="addressline" id="addressline" placeholder="Address Line" 
                               class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="city" style="font-size: 16px;font-weight: 500;">City</label>
                        <input type="text" name="city" id="city" placeholder="City" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="postalcode" style="font-size: 16px;font-weight: 500;">Postal Code</label>
                        <input type="text" name="postalcode" id="postalcode" placeholder="Postal Code" 
                               class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone" style="font-size: 16px;font-weight: 500;">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" style="font-size: 16px;font-weight: 500;">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="fax" style="font-size: 16px;font-weight: 500;">Fax</label>
                        <input type="text" name="fax" id="fax" placeholder="Fax" class="form-control py-2 mt-3">
                    </div>

                    {{-- <div class="form-group mb-3">
                        <label for="vatrn" style="font-size: 16px;font-weight: 500;">VAT Registration Number</label>
                        <input type="text" name="vatrn" id="vatrn" placeholder="VAT Registration Number" 
                               class="form-control py-2 mt-3">
                    </div> --}}

                    <div class="form-group mb-3">
                        <label for="status" style="font-size: 16px;font-weight: 500;">Status</label>
                        <select name="status" id="status" class="form-control py-2 mt-3">
                            <option value="">-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" style="text-decoration: none;font-size: 16px;font-weight: 600;border: 1px solid #18A689;color: #18A689;padding: 8px 21px;border-radius: 6px;" class=" mt-4">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
