{{-- @extends('system.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Edit Role</h2>
        <a href="{{ route('roles.index') }}" class="btn btn-dark">Back to Roles</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0 text-white">Update Role</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @csrf



                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Role Name</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name', $role->name) }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter Role Name">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label fw-semibold">Assign Permissions</label>
                    <div class="row">
                        @php
                            $groupedPermissions = $permissions->groupBy(function ($permission) {
                                return explode(' ', $permission->name)[1] ?? $permission->name;
                            });
                        @endphp

                        @if ($groupedPermissions->isNotEmpty())
                            @foreach ($groupedPermissions as $category => $perms)
                                <div class="col-md-6 mb-3">
                                    <div class="border p-3 rounded">
                                        <h6 class="text-primary fw-bold">{{ ucfirst($category) }}</h6>
                                        @foreach ($perms as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="permission-{{ $permission->name }}"
                                                    name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}>
                                                <label for="permission-{{ $permission->name }}" class="form-check-label">
                                                    {{ ucfirst(explode(' ', $permission->name)[0]) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No permissions available.</p>
                        @endif
                    </div>
                </div>


                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Update Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}



@extends('system.master')

@section('content')
<div class="containers mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Edit Role</h2>
        <a href="{{ route('roles.index') }}" class="btn btn-dark">
            <i class="fas fa-arrow-left me-1"></i> Back to Roles
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header text-white" style="background: #9718D3;">
            <h5 class="mb-0 text-white">Update Role & Permissions</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="post" id="roleForm">
                @csrf
                @method('PUT')

                {{-- Role Name --}}
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Role Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="e.g., Manager, Administrator" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Permissions List --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Assign Permissions</label>

                    @if($permissions->isEmpty())
                        <div class="alert alert-warning">
                            No permissions available to assign.
                        </div>
                    @else
                        <div class="row">
                            @php
                                // Group permissions by the second word in permission name
                                $groupedPermissions = $permissions->groupBy(function ($permission) {
                                    $parts = explode(' ', $permission->name);
                                    return count($parts) > 1 ? $parts[1] : 'other';
                                });
                            @endphp

                            @foreach($groupedPermissions as $category => $perms)
                                <div class="col-md-6 mb-3">
                                    <div class="border p-3 rounded">
                                        <h6 class="text-primary fw-bold">{{ ucfirst($category) }}</h6>
                                        @foreach($perms as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input permission-checkbox"
                                                    id="permission-{{ $permission->id }}"
                                                    name="permissions[]"
                                                    value="{{ $permission->id }}"
                                                    @if(in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())))
                                                        checked
                                                    @endif>
                                                <label for="permission-{{ $permission->id }}" class="form-check-label">
                                                    {{ ucfirst(explode(' ', $permission->name)[0]) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-sm btn-outline-primary me-2" id="selectAll">
                                <i class="fas fa-check-circle me-1"></i> Select All
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAll">
                                <i class="fas fa-times-circle me-1"></i> Deselect All
                            </button>
                        </div>

                        @if($role->permissions->isEmpty() && empty(old('permissions')))
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle me-2"></i> Currently no permissions are assigned to this role.
                            </div>
                        @endif
                    @endif

                    @error('permissions')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-success px-4" id="updateRoleBtn">
                        <i class="fas fa-save me-1"></i> Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select All / Deselect All functionality
        const selectAllBtn = document.getElementById('selectAll');
        const deselectAllBtn = document.getElementById('deselectAll');
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        const form = document.getElementById('roleForm');

        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
            });
        }

        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            });
        }

        // Form validation
        if (form) {
            form.addEventListener('submit', function(e) {
                const btn = document.getElementById('updateRoleBtn');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Updating...';
                return true;
            });
        }
    });
</script>
@endsection
