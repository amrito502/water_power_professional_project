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
                    <p style="font-size: 15px;font-weight: 400;margin-bottom: 0px;"><a href="{{ url('/') }}">Home</a> / Settings / Manage Company</p>
                    <a href="{{ route('companies.create') }}" style="display: inline-block;float: right;width: 140px;text-decoration: none;font-size: 16px;font-weight: 500;border: 1px solid #18A689;color: #18A689;padding: 10px 15px;border-radius: 6px;">Add Company</a>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table  table-striped table-bordered">
                        <div class="card-header" style="background: #F1F1F1;border: 1px solid #cdcdcd;">
                            <div class="search_filter d-flex justify-content-between">
                                <input type="text" placeholder="Search Name" class="form-control"
                                    style="width: 25%;border: 1px solid #cdcdcd; ">
                                <input type="text" placeholder="Search Domain" class="form-control"
                                    style="width: 25%;border: 1px solid #cdcdcd; margin-left: 20px;">
                                <input type="text" placeholder="Search Email" class="form-control"
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
                                    <th>Prefix</th>
                                    <th>Name</th>
                                    <th>Domain</th>
                                    <th>Email</th>
                                    <th>Favicon</th>
                                    <th>Logo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </div>
                        <div class="card-body">
                            <tbody>
                                @foreach ($companies as $key=>$company)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $company->orgIdPrefix }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->domain }}</td>
                                        <td>{{ $company->email }}</td>

                                        <td>
                                            <img src="{{ asset($company->favicon) }}" alt="favicon"
                                                style="width: 50px;">
                                        </td>
                                        <td>
                                            <img src="{{ asset($company->logo) }}" alt="favicon"
                                                style="width: 90px;">
                                        </td>
                                        <td>Active</td>
                                        <td>
                                            <div class="action_btn" style="display: flex;justify-content: center;align-items: center;width: 100%;">
                                                <a style="font-size: 17px;margin-right: 16px;color: #ffffff;" class="btn btn-sm btn-success" href="">View</a>
                                                <a style="font-size: 17px;margin-right: 16px;color: #ffffff;" class="btn btn-sm btn-info" href="{{ route('companies.edit', $company->id) }}">Edit</a>
                                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
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
