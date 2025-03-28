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
                <h2 style="font-weight: 700;color: #383535;margin-bottom: 15px;">Company</h2>
                <div class="url_page">
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;"><a href="{{ url('/') }}">Home</a> /
                        Settings / Manage Company / Edit Company</p>
                        <a href="{{ route('companies.index') }}" style="display: inline-block;float: right;width: 137px;text-decoration: none;font-size: 16px;font-weight: 500;border: 1px solid #18A689;color: #18A689;padding: 10px 15px;border-radius: 6px;">Company List</a>
                </div>

            </div>
            <div class="card p-5">
                <form action="{{ route('companies.update', $company->id) }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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

                    <div class="form-group mb-3">
                        <label for="name" style="font-size: 16px;font-weight: 500;">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name" 
                               value="{{ old('name', $company->name) }}" 
                               class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="domain" style="font-size: 16px;font-weight: 500;">Domain</label>
                        <input type="text" name="domain" id="domain" placeholder="Domain" 
                               value="{{ old('domain', $company->domain) }}" 
                               class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" style="font-size: 16px;font-weight: 500;">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" 
                               value="{{ old('email', $company->email) }}" 
                               class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="favicon" style="font-size: 16px;font-weight: 500;">Favicon</label>
                        <input type="file" name="favicon" id="favicon" 
                               class="form-control py-2 mt-3">
                        @if($company->favicon)
                            <div class="mt-2">
                                <img src="{{ asset( $company->favicon) }}" alt="Favicon" width="50">
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="logo" style="font-size: 16px;font-weight: 500;">Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control py-2 mt-3">
                        @if($company->logo)
                            <div class="mt-2">
                                <img src="{{ asset( $company->logo) }}" alt="Logo" width="50">
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" style="font-size: 16px;font-weight: 500;">Status</label>
                        <select name="status" id="status" class="form-control py-2 mt-3">
                            <option value="1" {{ old('status', $company->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $company->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" 
                                style="text-decoration: none;font-size: 16px;font-weight: 600;border: 1px solid #18A689;color: #18A689;padding: 8px 21px;border-radius: 6px;" 
                                class="mt-4">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
