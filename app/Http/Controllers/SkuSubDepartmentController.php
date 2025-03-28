<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkuSubDepartment;
use App\Models\SkuDepartment;

class SkuSubDepartmentController extends Controller
{
    public function index()
    {
        $subDepartments = SkuSubDepartment::with('department')->get();
        return view('system.components.sku_sub_departments.index', compact('subDepartments'));
    }

    public function create()
    {
        $departments = SkuDepartment::all();
        return view('system.components.sku_sub_departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku_department_id' => 'nullable|exists:sku_departments,id',
            'name' => 'required|string|max:50',
            'status' => 'required|integer',
            'rank' => 'required|integer'
        ]);

        SkuSubDepartment::create($request->all());

        return redirect()->route('sku_sub_departments.index')->with('success', 'Sub-Department created successfully.');
    }

    public function edit(SkuSubDepartment $sku_sub_department)
    {
        $departments = SkuDepartment::all();
        return view('system.components.sku_sub_departments.edit', compact('sku_sub_department', 'departments'));
    }

    public function update(Request $request, SkuSubDepartment $sku_sub_department)
    {
        $request->validate([
            'sku_department_id' => 'nullable|exists:sku_departments,id',
            'name' => 'required|string|max:50',
            'status' => 'required|integer',
            // 'rank' => 'required|integer'
        ]);

        $sku_sub_department->update($request->all());

        return redirect()->route('sku_sub_departments.index')->with('success', 'Sub-Department updated successfully.');
    }

    public function destroy(SkuSubDepartment $sku_sub_department)
    {
        $sku_sub_department->delete();

        return redirect()->route('sku_sub_departments.index')->with('success', 'Sub-Department deleted successfully.');
    }
}
