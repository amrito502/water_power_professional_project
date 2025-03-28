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
                <h2 style="font-weight: 700;color: #383535;margin-bottom: 15px;">Edit User</h2>
                <div class="url_page">
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;">
                        <a href="{{ url('/') }}">Home</a> /
                        User Management / Edit User
                    </p>
                    <a href="{{ route('users') }}"
                        style="display: inline-block;float: right;width: 137px;text-decoration: none;font-size: 16px;font-weight: 500;border: 1px solid #18A689;color: #18A689;padding: 10px 15px;border-radius: 6px;">
                        Users List
                    </a>
                </div>
            </div>

            <div class="card p-5">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $user->branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="zone_id" style="font-size: 16px;font-weight: 500;">Zone</label>
                        <select name="zone_id" id="zone_id" class="form-control py-2 mt-3">
                            <option value="">-- Select Zone --</option>
                            @foreach ($zones as $zone)
                                <option value="{{ $zone->id }}" {{ $user->zone_id == $zone->id ? 'selected' : '' }}>
                                    {{ $zone->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="role" style="font-size: 16px;font-weight: 500;">Commission Type</label>
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $key => $role)
                                <div class="form-control py-2 mt-3" style="cursor: pointer;">
                                    <input {{ $hasRoles->contains($role->id) ? 'checked' : '' }} style="cursor: pointer;"
                                        type="checkbox" id="role-{{ $role->name }}" name="role[]"
                                        value="{{ $role->name }}" class="rounded">
                                    <label style="cursor: pointer;"
                                        for="role-{{ $role->name }}">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>



                    <div class="form-group mb-3">
                        <label for="name" style="font-size: 16px;font-weight: 500;">Name</label>
                        <input type="text" name="name" id="name" class="form-control py-2 mt-3"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="mobile" style="font-size: 16px;font-weight: 500;">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control py-2 mt-3"
                            value="{{ old('mobile', $user->mobile) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" style="font-size: 16px;font-weight: 500;">Email</label>
                        <input type="email" name="email" id="email" class="form-control py-2 mt-3"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="username" style="font-size: 16px;font-weight: 500;">Username</label>
                        <input type="text" name="username" id="username" class="form-control py-2 mt-3"
                            value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" style="font-size: 16px;font-weight: 500;">New Password (Leave blank if
                            unchanged)</label>
                        <input type="password" name="password" id="password" class="form-control py-2 mt-3">
                    </div>

            
                    <div class="form-group mb-3">
                        <label for="photo" style="font-size: 16px;font-weight: 500;">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control py-2 mt-3">
                        @if ($user->photo)
                            <img src="{{ asset($user->photo) }}" class="mt-2" width="100" alt="User Photo">
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" style="font-size: 16px;font-weight: 500;">Status</label>
                        <select name="status" id="status" class="form-control py-2 mt-3">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit"
                            style="text-decoration: none;font-size: 16px;font-weight: 600;border: 1px solid #18A689;color: #18A689;padding: 8px 21px;border-radius: 6px;"
                            class=" mt-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
