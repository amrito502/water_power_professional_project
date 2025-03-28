@extends('system.master')

@section('content')
    <div class="container">
        <h2>Brands</h2>

        <a class="btn btn-success my-3" href="{{ route('brands.create') }}">Create Tax</a>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Rank</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            @if ($brand->image)
                                <img src="{{ asset($brand->image) }}" width="50" height="50"
                                    alt="{{ $brand->name }}">
                            @endif
                        </td>
                        <td>{{ $brand->status ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $brand->rank }}</td>
                        <td>
                            <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
