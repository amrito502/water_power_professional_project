@extends('system.master')

@section('content')

    <div class="row d-flex">
        <div class="col-md-6">
            <h1 class="mb-3" style="font-weight: 500;font-size: 25px;">Edit SKU</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            {{-- <a href="{{ route('change.sku.price') }}" class="btn btn-info mb-3 mt-1 mx-3">Change Price</a> --}}
            {{-- <a href="{{ route('skus.index') }}" class="btn btn-primary mb-3 mt-1 ">View SKU</a> --}}
        </div>
    </div>
    <div class="card p-4">
    <!-- Form for editing an existing SKU -->
        <form action="{{ route('skus.update', $sku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- SKU Name -->
            <div class="form-group mb-3">
                <label for="sku_name" style="font-weight: 500;margin-bottom: 8px;">SKU Name</label>
                <input type="text" name="sku_name" id="sku_name" class="form-control" value="{{ old('sku_name', $sku->sku_name) }}">
                @error('sku_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Cost Price -->
                    <div class="form-group mb-3">
                        <label for="cost_price" style="font-weight: 500;margin-bottom: 8px;">Cost Price</label>
                        <input type="number" step="0.01" name="cost_price" id="cost_price" class="form-control" value="{{ old('cost_price', $sku->cost_price) }}">
                        @error('cost_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                <!-- Sell Price -->
                <div class="form-group mb-3">
                    <label for="sell_price" style="font-weight: 500;margin-bottom: 8px;">Sell Price</label>
                    <input type="number" step="0.01" name="sell_price" id="sell_price" class="form-control" value="{{ old('sell_price', $sku->sell_price) }}">
                    @error('sell_price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                </div>
            </div>

         
            <!-- SKU Brand -->
            <div class="form-group mb-3">
                <label for="brand_id" style="font-weight: 500;margin-bottom: 8px;">SKU Brand</label>
                <select name="brand_id" id="sku_brand_id" class="form-control">
                    <option value="">-- Select SKU Brand --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $sku->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- SKU Department -->
            <div class="form-group mb-3">
                <label for="sku_department_id" style="font-weight: 500;margin-bottom: 8px;">SKU Department</label>
                <select name="sku_department_id" id="sku_department_id" class="form-control" onchange="fetchSubDepartments(this.value)">
                    <option value="">-- Select SKU Department --</option>
                    @foreach($skuDepartments as $department)
                        <option value="{{ $department->id }}" {{ old('sku_department_id', $sku->sku_department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('sku_department_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- SKU Sub-Department -->
            <div class="form-group mb-3">
                <label for="sku_sub_department_id" style="font-weight: 500;margin-bottom: 8px;">SKU Sub-Department</label>
                <select name="sku_sub_department_id" id="sku_sub_department_id" class="form-control" onchange="fetchCategories(this.value)">
                    <option value="">-- Select Sub SKU Department --</option>
                    @if($sku->sku_sub_department_id)
                        <option value="{{ $sku->sku_sub_department_id }}" selected>{{ $sku->subDepartment->name }}</option>
                    @endif
                </select>
                @error('sku_sub_department_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="form-group mb-3">
                <label for="categorie_id" style="font-weight: 500;margin-bottom: 8px;">Category</label>
                <select name="categorie_id" id="categorie_id" class="form-control">
                    <option value="">-- Select SKU Category --</option>
                    @if($sku->categorie_id)
                        <option value="{{ $sku->categorie_id }}" selected>{{ $sku->category->name }}</option>
                    @endif
                </select>
                @error('categorie_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tax -->
            <div class="form-group mb-3">
                <label for="tax_id" style="font-weight: 500;margin-bottom: 8px;">Tax %</label>
                <select name="tax_id" id="tax_id" class="form-control">
                    <option value="">-- Select Tax --</option>
                    @foreach($taxes as $tax)
                        <option value="{{ $tax->id }}" {{ old('tax_id', $sku->tax_id) == $tax->id ? 'selected' : '' }}>{{ $tax->tax_rate }}</option>
                    @endforeach
                </select>
                @error('tax_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

               <!-- SKU Image -->
               <div class="form-group mb-3">
                <label for="image" style="font-weight: 500;margin-bottom: 8px;">SKU Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($sku->image)
                    <img src="{{ asset( $sku->image) }}" alt="SKU Image" width="100" class="mt-2">
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Status -->
            <div class="form-group mb-3">
                <label for="status" style="font-weight: 500;margin-bottom: 8px;">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ old('status', $sku->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $sku->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Update SKU</button>
            <a href="{{ route('skus.index') }}" class="btn btn-danger">chancel</a>
        </form>
    </div>

<!-- Axios for Dynamic Dropdowns -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Fetch Sub-Departments based on selected Department
    function fetchSubDepartments(departmentId) {
        const subDepartmentSelect = document.getElementById('sku_sub_department_id');
        subDepartmentSelect.innerHTML = '<option value="">-- Select Sub-Department --</option>'; // Reset dropdown

        if (departmentId) {
            axios.get(`/get-sub-departments/${departmentId}`)
                .then(response => {
                    const subDepartments = response.data;
                    subDepartments.forEach(subDept => {
                        const option = document.createElement('option');
                        option.value = subDept.id;
                        option.textContent = subDept.name;
                        subDepartmentSelect.appendChild(option);
                    });

                    // Pre-select the current sub-department
                    const currentSubDepartmentId = "{{ $sku->sku_sub_department_id }}";
                    if (currentSubDepartmentId) {
                        subDepartmentSelect.value = currentSubDepartmentId;
                        fetchCategories(currentSubDepartmentId); // Fetch categories for the current sub-department
                    }
                })
                .catch(error => {
                    console.error('Error fetching sub-departments:', error);
                });
        }
    }

    // Fetch Categories based on selected Sub-Department
    function fetchCategories(subDepartmentId) {
        const categorySelect = document.getElementById('categorie_id');
        categorySelect.innerHTML = '<option value="">-- Select Category --</option>'; // Reset dropdown

        if (subDepartmentId) {
            axios.get(`/get-categories/${subDepartmentId}`)
                .then(response => {
                    const categories = response.data;
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        categorySelect.appendChild(option);
                    });

                    // Pre-select the current category
                    const currentCategoryId = "{{ $sku->categorie_id }}";
                    if (currentCategoryId) {
                        categorySelect.value = currentCategoryId;
                    }
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                });
        }
    }

    // Initialize dynamic dropdowns on page load
    document.addEventListener('DOMContentLoaded', function () {
        const departmentId = "{{ $sku->sku_department_id }}";
        if (departmentId) {
            fetchSubDepartments(departmentId);
        }
    });
</script>
@endsection
