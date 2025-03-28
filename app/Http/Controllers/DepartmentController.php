<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('system.components.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:150',
            'status' => 'nullable|integer',
        ]);

        Department::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department Created Successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('system.components.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'nullable|string|max:150',
            'status' => 'nullable|integer',
        ]);

        $department->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department Deleted Successfully!');
    }
}
