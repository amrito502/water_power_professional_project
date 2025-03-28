@extends('system.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Manage Permissions</h2>
        <a href="{{ route('permissions.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Create Permission
        </a>
    </div>

    @include('system.components.message')

    <div class="card shadow-sm">
        <div class="card-header text-white" style="background: #9718D3;">
            <h5 class="mb-0 text-white">Permissions List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="" style="background: #e0caeb;">
                        <tr>
                            <th>#</th>
                            <th>Permission Name</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $key => $permission)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="fw-semibold">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deletePermission({{ $permission->id }})">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center text-muted">No permissions available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function deletePermission(id){
        if(confirm("Are you sure you want to delete this permission?")){
            $.ajax({
                url : '{{ route("permissions.destroy") }}',
                type : 'DELETE',
                data : {id: id},
                dataType : 'json',
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                success : function(response){
                    location.reload();
                }
            });
        }
    }
</script>
@endsection
