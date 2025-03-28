{{--
@extends('system.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Create New Role</h2>
        <a href="{{ route('roles.index') }}" class="btn btn-dark">Back to Roles</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0 text-white">Define Role & Assign Permissions</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Role Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
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
                                return explode('.', $permission->name)[0];
                            });
                        @endphp

                        @foreach ($groupedPermissions as $category => $perms)
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded">
                                    <h6 class="text-primary fw-bold">{{ ucfirst($category) }}</h6>
                                    @foreach ($perms as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="permission-{{ $permission->name }}"
                                                name="permission[]" value="{{ $permission->name }}">
                                            <label for="permission-{{ $permission->name }}" class="form-check-label">
                                                {{ ucfirst(str_replace('_', ' ', explode('.', $permission->name)[1] ?? $permission->name)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 --}}



 @extends('system.master')

 @section('content')
 <div class="containers mt-4">
     <div class="d-flex justify-content-between align-items-center mb-3">
         <h2 class="fw-bold">Create New Role</h2>
         <a href="{{ route('roles.index') }}" class="btn btn-dark">
             <i class="fas fa-arrow-left me-1"></i> Back to Roles
         </a>
     </div>

     <div class="card shadow-sm">
         <div class="card-header text-white" style="background: #9718D3;">
             <h5 class="mb-0 text-white">Define Role & Assign Permissions</h5>
         </div>
         <div class="card-body">
             <form action="{{ route('roles.store') }}" method="post" id="roleForm">
                 @csrf

                 {{-- Role Name --}}
                 <div class="mb-4">
                     <label for="name" class="form-label fw-semibold">Role Name <span class="text-danger">*</span></label>
                     <input type="text" id="name" name="name" value="{{ old('name') }}"
                         class="form-control @error('name') is-invalid @enderror"
                         placeholder="e.g., Manager, Administrator" required>
                     @error('name')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                 </div>

                 {{-- Permissions List --}}
                 <div class="mb-3">
                     <label class="form-label fw-semibold">Assign Permissions</label>
                     <div class="row">
                         @php
                             // Group permissions by the second word in permission name
                             $groupedPermissions = $permissions->groupBy(function ($permission) {
                                 $parts = explode(' ', $permission->name);
                                 return count($parts) > 1 ? $parts[1] : 'other';
                             });
                         @endphp

                         @if ($groupedPermissions->isNotEmpty())
                             @foreach ($groupedPermissions as $category => $perms)
                                 <div class="col-md-6 mb-3">
                                     <div class="border p-3 rounded">
                                         <h6 class="text-primary fw-bold">{{ ucfirst($category) }}</h6>
                                         @foreach ($perms as $permission)
                                             <div class="form-check">
                                                 <input type="checkbox" class="form-check-input permission-checkbox"
                                                     id="permission-{{ $permission->id }}"
                                                     name="permissions[]"
                                                     value="{{ $permission->id }}"
                                                     {{ is_array(old('permissions')) && in_array($permission->id, old('permissions')) ? 'checked' : '' }}
                                                     {{ isset($role) && $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                 <label for="permission-{{ $permission->id }}" class="form-check-label">
                                                     {{ ucfirst(explode(' ', $permission->name)[0]) }}
                                                 </label>
                                             </div>
                                         @endforeach
                                     </div>
                                 </div>
                             @endforeach

                             <div class="col-12 mt-2">
                                 <button type="button" class="btn btn-sm btn-outline-primary me-2" id="selectAll">
                                     <i class="fas fa-check-circle me-1"></i> Select All
                                 </button>
                                 <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAll">
                                     <i class="fas fa-times-circle me-1"></i> Deselect All
                                 </button>
                             </div>
                         @else
                             <p class="text-muted">No permissions available.</p>
                         @endif
                     </div>
                 </div>

                 <div class="d-flex justify-content-between align-items-center mt-4">
                     <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                         Cancel
                     </a>
                     <button type="submit" class="btn btn-success px-4" id="createRoleBtn">
                         <i class="fas fa-save me-1"></i> Create Role
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
                 const btn = document.getElementById('createRoleBtn');
                 const checkedPermissions = document.querySelectorAll('.permission-checkbox:checked');

                 if (checkedPermissions.length === 0) {
                     e.preventDefault();
                     alert('Please select at least one permission');
                     return false;
                 }

                 btn.disabled = true;
                 btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing...';
                 return true;
             });
         }
     });
 </script>
 @endsection
