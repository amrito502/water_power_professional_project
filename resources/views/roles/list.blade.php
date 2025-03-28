
@extends('system.master')
@section('content')
<div class="containers mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Manage Roles</h2>
        <a href="{{ route('roles.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Create Role
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header text-white" style="background: #9718D3;">
            <h5 class="mb-0 text-white">Roles & Permissions</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="" style="background: #e0caeb;">
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="fw-semibold">{{ ucfirst($role->name) }}</td>
                                    <td>
                                        @if ($role->permissions->isNotEmpty())
                                            <span class="badge bg-primary">
                                                {{ $role->permissions->count() }} Permissions
                                            </span>
                                            <button class="btn btn-link text-decoration-none p-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#permissionsModal-{{ $role->id }}">
                                                View
                                            </button>

                                            <!-- Modal for Role Permissions -->
                                            <div class="modal fade" id="permissionsModal-{{ $role->id }}" tabindex="-1"
                                                 aria-labelledby="permissionsModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Permissions for {{ ucfirst($role->name) }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group">
                                                                @foreach ($role->permissions as $permission)
                                                                    <li class="list-group-item">
                                                                        {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">No Permissions Assigned</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteRole({{ $role->id }})">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">No roles available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function deleteRole(id){
        if(confirm("Are you sure you want to delete this role?")){
            $.ajax({
                url : '{{ route("roles.destroy") }}',
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
