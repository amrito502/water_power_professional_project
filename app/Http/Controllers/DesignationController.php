<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Designation::with('department')->get();
        return view('system.components.designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('system.components.designation.create', compact('departments'));
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

        Designation::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'status' => $request->status,
        ]);

        return redirect()->route('designations.index')->with('success', 'Designation Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        $departments = Department::all();
        return view('system.components.designation.edit', compact('departments','designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'name' => 'nullable|string|max:150',
            'status' => 'nullable|integer',
        ]);

        $designation->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'status' => $request->status,
        ]);

        return redirect()->route('designations.index')->with('success', 'Designation Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('designations.index')->with('success', 'Designation Deleted Successfully!');
    }
}
