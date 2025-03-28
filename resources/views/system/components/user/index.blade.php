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
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;"><a href="{{ url('/') }}">Home</a> / Settings / Manage Users</p>
                    <a href="{{ route('users.create') }}" style="display: inline-block;float: right;width: 140px;text-decoration: none;font-size: 16px;font-weight: 500;border: 1px solid #18A689;color: #18A689;padding: 10px 15px;border-radius: 6px;">Add Users</a>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table  table-striped table-bordered">
                        <div class="card-header" style="background: #F1F1F1;border: 1px solid #cdcdcd;">
                            <div class="search_filter d-flex justify-content-between">
                                <input type="text" placeholder="Search By Name" class="form-control"
                                    style="width: 25%;border: 1px solid #cdcdcd; ">
                                <input type="text" placeholder="Search By Domain" class="form-control"
                                    style="width: 25%;border: 1px solid #cdcdcd; margin-left: 20px;">
                                <input type="text" placeholder="Search By Email" class="form-control"
                                    style="width: 25%;border: 1px solid #cdcdcd; margin-left: 20px;">

                                <select name="" id="" class="form-control"
                                style="width: 25%;border: 1px solid #cdcdcd; margin-left: 20px;">
                                    <option value="">-- Select Status --</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="processing">Processing</option>
                                    <option value="cancel">Cancel</option>
                                    <option value="return">Return</option>
                                </select>

                            </div>
                            <thead class="table">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>username</th>
                                    <th>mobile</th>
                                    <th>email</th>
                                    <th>branch</th>
                                    <th>zone</th>
                                    <th>roles</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </div>
                        <div class="card-body">
                            <tbody>
                                @foreach ($users as $key=>$user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name ?? 'N/A' }}</td>
                                    <td>{{ $user->username ?? 'N/A' }}</td>
                                    <td>{{ $user->mobile ?? 'N/A' }}</td>
                                    <td>{{ $user->email ?? 'N/A' }}</td>
                                    <td>{{ $user->branch->name ?? 'N/A' }}</td>
                                    <td>{{ $user->zone->name ?? 'N/A' }}</td>
                                    <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                    <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                
                                    <td>
                                        <div class="action_btn" style="display: flex;justify-content: center;align-items: center;width: 100%;">
                                            <a style="font-size: 17px;margin-right: 16px;color: #ffffff;" class="btn btn-sm btn-success" href="">View</a>
                                            <a style="font-size: 17px;margin-right: 16px;color: #ffffff;" class="btn btn-sm btn-info" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                            <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="font-size: 17px;color: hsl(0, 0%, 100%);" class="btn btn-sm btn-danger"
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
