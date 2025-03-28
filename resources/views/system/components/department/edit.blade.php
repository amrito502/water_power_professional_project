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
                <h2 style="font-weight: 700;color: #383535;margin-bottom: 15px;">Department</h2>
                <div class="url_page">
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;">
                        <a href="{{ url('/') }}">Home</a> / Settings / HR Module / Edit Department
                    </p>
                    <a class="btn btn-info" href="{{ route('departments.index') }}" style="float: right">
                        View Department
                    </a>
                </div>
            </div>
            <div class="card p-5">
                <form action="{{ route('departments.update', $department->id) }}" class="form" method="POST" enctype="multipart/form-data">
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
                        <label for="name" style="font-size: 16px;font-weight: 500;">Department Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}" placeholder="Name" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" style="font-size: 16px;font-weight: 500;">Status</label>
                        <select name="status" id="status" class="form-control py-2 mt-3">
                            <option value="1" {{ old('status', $department->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $department->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info mt-4">
                            Update Department
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
