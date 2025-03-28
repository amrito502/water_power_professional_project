@extends('system.master')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Edit Permission</h2>
        <a href="{{ route('permissions.index') }}" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i> Back to Permissions
        </a>
    </div>

    @include('system.components.message')

    <div class="card shadow-sm">
        <div class="card-header text-white" style="background: #9718D3;">
            <h5 class="mb-0 text-white">Update Permission Details</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                @csrf

                {{-- Permission Name Input --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Permission Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $permission->name) }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter Permission Name">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Update Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
