@extends('system.master')

@section('content')
    <div class="containers">
        <h2>Shareholder List</h2>

        <a href="{{ route('shareholders.create') }}" class="btn btn-primary mb-3">Create New Shareholder</a>

        <div class="card p-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address Line</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Share Percent</th>
                        <th>Opening Balance</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shareholders as $shareholder)
                        <tr>
                            <td>{{ $shareholder->name }}</td>
                            <td>{{ $shareholder->gender }}</td>
                            <td>{{ $shareholder->addressline }}</td>
                            <td>{{ $shareholder->city }}</td>
                            <td>{{ $shareholder->phone }}</td>
                            <td>{{ $shareholder->email }}</td>
                            <td>{{ $shareholder->sharePercent }}%</td>
                            <td>{{ number_format($shareholder->opening_balance, 2) }}</td>
                            <td>{{ $shareholder->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $shareholder->creator->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('shareholders.edit', $shareholder->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('shareholders.destroy', $shareholder->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this shareholder?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
