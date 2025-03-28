<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('system.components.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'suppId' => 'required|string|max:150',
            'name' => 'required|string|max:50',
            'crType' => 'nullable|in:credit,consignment',
            'creditDay' => 'nullable|integer',
            'consignmentDay' => 'nullable|integer',
            'ob' => 'nullable|numeric',
            'phone' => 'nullable|string|max:150',
            'email' => 'nullable|email|max:150',
            'address' => 'nullable|string|max:250',
            'city' => 'nullable|string|max:150',
            'status' => 'nullable|in:active,inactive',
        ]);


        Supplier::create([
            'suppId' => $request->input('suppId'),
            'name' => $request->input('name'),
            'crType' => $request->input('crType'),
            'creditDay' => $request->input('crType') == 'credit' ? $request->input('creditDay') : 0,
            'consignmentDay' => $request->input('crType') == 'consignment' ? $request->input('consignmentDay') : 0,
            'ob' => $request->input('ob', 0.00),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'status' => $request->input('status') === 'active' ? 1 : 0,
            'createdBy' => auth()->id(),
            'rank' => 5,
        ]);


        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('system.components.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'suppId' => 'required|string|max:150',
            'name' => 'required|string|max:50',
            'crType' => 'nullable|in:credit,consignment',
            'creditDay' => 'nullable|integer',
            'consignmentDay' => 'nullable|integer',
            'ob' => 'nullable|numeric',
            'phone' => 'nullable|string|max:150',
            'email' => 'nullable|email|max:150',
            'address' => 'nullable|string|max:250',
            'city' => 'nullable|string|max:150',
            'status' => 'nullable|in:active,inactive',
        ]);
    
       
        $supplier->update([
            'suppId' => $request->input('suppId'),
            'name' => $request->input('name'),
            'crType' => $request->input('crType'),
            'creditDay' => $request->input('crType') == 'credit' ? $request->input('creditDay') : 0,
            'consignmentDay' => $request->input('crType') == 'consignment' ? $request->input('consignmentDay') : 0,
            'ob' => $request->input('ob', 0.00),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'status' => $request->input('status') === 'active' ? 1 : 0,
            'updatedBy' => auth()->id(), 
            'rank' => $supplier->rank ?? 5,
        ]);
    
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier Deleted successfully!');
    }
}
