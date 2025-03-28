<?php

namespace App\Http\Controllers;

use App\Models\SkuDepartment;
use Illuminate\Http\Request;

class SkuDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = SkuDepartment::all();
        return view('system.components.sku_departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.sku_departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'status' => 'required|integer',
            'rank' => 'required|integer'
        ]);

        SkuDepartment::create($request->all());

        return redirect()->route('sku_departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SkuDepartment $skuDepartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SkuDepartment $skuDepartment)
    {
        $sku_department = $skuDepartment;
        return view('system.components.sku_departments.edit', compact('sku_department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkuDepartment $skuDepartment)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'status' => 'required|integer',
            'rank' => 'required|integer'
        ]);

        $skuDepartment->update($request->all());

        return redirect()->route('sku_departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkuDepartment $skuDepartment)
    {
        $skuDepartment->delete();

        return redirect()->route('sku_departments.index')->with('success', 'Department deleted successfully.');
    }
}
