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
                <h2 style="font-weight: 700;color: #383535;margin-bottom: 15px;">Users</h2>
                <div class="url_page">
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;"><a href="{{ url('/') }}">Home</a> /
                        User Management / Create User</p>
                    <a href="{{ route('users') }}"
                        style="display: inline-block;float: right;width: 137px;text-decoration: none;font-size: 16px;font-weight: 500;border: 1px solid #18A689;color: #18A689;padding: 10px 15px;border-radius: 6px;">Users
                        List</a>
                </div>

            </div>
            <div class="card p-5">
                <form action="{{ url('users/store') }}" class="form" method="POST" enctype="multipart/form-data">
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

                    <div class="form-group mb-3">
                        <label for="branch_id" style="font-size: 16px;font-weight: 500;">Area / Branch</label>
                        <select name="branch_id" id="branch_id" class="form-control py-2 mt-3">
                            <option value="">-- Select Area / Branch --</option>
                            @if ($branches->isNotEmpty())
                                @foreach ($branches as $key => $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="zone_id" style="font-size: 16px;font-weight: 500;">Zone</label>
                        <select name="zone_id" id="zone_id" class="form-control py-2 mt-3">
                            <option value="">-- Select Zone --</option>
                            @if ($zones->isNotEmpty())
                                @foreach ($zones as $key => $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="role" style="font-size: 16px;font-weight: 500;">Commission Type</label>
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $key => $role)
                                <div class="form-control py-2 mt-3" style="cursor: pointer;">
                                    <input style="cursor: pointer;" type="checkbox" id="role-{{ $role->name }}"
                                        name="role[]" value="{{ $role->name }}" class="rounded">
                                    <label style="cursor: pointer;"
                                        for="role-{{ $role->name }}">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>


                    <div class="form-group mb-3">
                        <label for="name" style="font-size: 16px;font-weight: 500;">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name"
                            class="form-control py-2 mt-3">
                    </div>
                    <div class="form-group mb-3">
                        <label for="mobile" style="font-size: 16px;font-weight: 500;">Mobile</label>
                        <input type="text" name="mobile" id="mobile" placeholder="mobile"
                            class="form-control py-2 mt-3">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" style="font-size: 16px;font-weight: 500;">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="username" style="font-size: 16px;font-weight: 500;">Username </label>
                        <input type="text" name="username" id="username" placeholder="username"
                            class="form-control py-2 mt-3">
                    </div>


                    <div class="form-group mb-3">
                        <label for="password" style="font-size: 16px;font-weight: 500;">Password </label>
                        <input type="password" name="password" id="password" placeholder="password"
                            class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="confirm_password" style="font-size: 16px;font-weight: 500;">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm_password"
                            class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="photo" style="font-size: 16px;font-weight: 500;">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" style="font-size: 16px;font-weight: 500;">Status</label>
                        <select name="status" id="status" class="form-control py-2 mt-3">
                            <option value="">-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit"
                            style="text-decoration: none;font-size: 16px;font-weight: 600;border: 1px solid #18A689;color: #18A689;padding: 8px 21px;border-radius: 6px;"
                            class=" mt-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
