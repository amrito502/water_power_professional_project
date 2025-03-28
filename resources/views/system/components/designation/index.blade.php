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
                <h2 style="font-weight: 700;color: #383535;margin-bottom: 15px;">Designation</h2>
                <div class="url_page">
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;"><a href="{{ url('/') }}">Home</a> / HR / Manage Designation</p>
                    <a href="{{ route('designations.create') }}" style="float: right;" class="btn btn-info">Add Designation</a>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table  table-striped table-bordered">
                        <div class="card-header" style="background: #F1F1F1;border: 1px solid #cdcdcd;">
                            <div class="search_filter d-flex justify-content-between">
                                <input type="text" placeholder="Search Name" class="form-control"
                                    style="width: 25%;border: 1px solid #cdcdcd; ">


                                {{-- <select name="" id="" class="form-control"
                                style="width: 25%;border: 1px solid #cdcdcd; margin-left: 20px;">
                                    <option value="">-- Select Status --</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="processing">Processing</option>
                                    <option value="cancel">Cancel</option>
                                    <option value="return">Return</option>
                                </select> --}}

                            </div>
                            <thead class="table">
                                <tr>
                                    <th>SL</th>
                                    <th>Department Name</th>
                                    <th>Designation Name</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </div>
                        <div class="card-body">
                            <tbody>
                                @foreach ($designations as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->department->name ?? 'N/A' }}</td>
                                    <td>{{ $item->name ?? 'N/A' }}</td>
                                    <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>

                                    <td>
                                        <div class="action_btn" style="display: flex;justify-content: center;align-items: center;width: 100%;">
                                            <a style="font-size: 17px;margin-right: 16px;color: #ffffff;" class="btn btn-warning" href="{{ route('designations.edit', $item->id) }}">Edit</a>
                                            <form action="{{ route('designations.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="font-size: 17px;color: hsl(0, 0%, 100%);" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
