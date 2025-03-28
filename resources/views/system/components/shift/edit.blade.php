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
                <h2 style="font-weight: 700;color: #383535;margin-bottom: 15px;">Edit Shift</h2>
                <div class="url_page">
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;">
                        <a href="{{ url('/') }}">Home</a> / Settings / HR Module / Edit Shift
                    </p>
                    <a class="btn btn-info" href="{{ route('shifts.index') }}" style="float: right">
                        View Shifts
                    </a>
                </div>
            </div>
            <div class="card p-5">
                <form action="{{ route('shifts.update', $shift->id) }}" method="POST">
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
                        <label for="shift_name" style="font-size: 16px;font-weight: 500;">Shift Name</label>
                        <input type="text" name="shift_name" id="shift_name" value="{{ $shift->shift_name }}" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="start_time" style="font-size: 16px;font-weight: 500;">Start Time</label>
                        <input type="time" name="start_time" id="start_time" value="{{ $shift->start_time }}" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="end_time" style="font-size: 16px;font-weight: 500;">End Time</label>
                        <input type="time" name="end_time" id="end_time" value="{{ $shift->end_time }}" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="break_duration" style="font-size: 16px;font-weight: 500;">Break Duration (minutes)</label>
                        <input type="number" name="break_duration" id="break_duration" value="{{ $shift->break_duration }}" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="recurrence" style="font-size: 16px;font-weight: 500;">Recurrence</label>
                        <input type="text" name="recurrence" id="recurrence" value="{{ $shift->recurrence }}" placeholder="Daily, Weekly, Custom" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="applicable_days" style="font-size: 16px;font-weight: 500;">Applicable Days</label>
                        <input type="text" name="applicable_days" id="applicable_days" value="{{ $shift->applicable_days }}" placeholder="e.g., Monday, Tuesday" class="form-control py-2 mt-3">
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" style="font-size: 16px;font-weight: 500;">Status</label>
                        <select name="status" id="status" class="form-control py-2 mt-3">
                            <option value="1" {{ $shift->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $shift->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info mt-4">
                            Update Shift
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
