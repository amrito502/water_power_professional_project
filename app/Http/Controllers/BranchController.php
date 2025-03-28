<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('system.components.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           // Create new branch instance
        $branch = new Branch();

        // Assign form values to the branch object
        $branch->branchIdPrefix = $request->branchIdPrefix ?? 'N/A';
        $branch->name = $request->name ?? 'N/A';
        $branch->addressline = $request->addressline ?? 'N/A';
        $branch->city = $request->city ?? 'N/A';
        $branch->postalcode = $request->postalcode ?? 'N/A';
        $branch->phone = $request->phone ?? 'N/A';
        $branch->email = $request->email ?? 'N/A';
        $branch->fax = $request->fax ?? 'N/A';
        $branch->vatrn = $request->vatrn ?? 'N/A';
        $branch->status = $request->status; 

        // Save the branch to the database
        $branch->save();

        // Redirect back with success message
        return redirect()->route('branches.index')->with('success', 'Branch created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        $data["branch"]  = $branch;
        return view('system.components.branch.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
            // Assign form values to the branch object
            $branch->branchIdPrefix = $request->branchIdPrefix ?? 'N/A';
            $branch->name = $request->name ?? 'N/A';
            $branch->addressline = $request->addressline ?? 'N/A';
            $branch->city = $request->city ?? 'N/A';
            $branch->postalcode = $request->postalcode ?? 'N/A';
            $branch->phone = $request->phone ?? 'N/A';
            $branch->email = $request->email ?? 'N/A';
            $branch->fax = $request->fax ?? 'N/A';
            $branch->vatrn = $request->vatrn ?? 'N/A';
            $branch->status = $request->status; 
    
            // Save the branch to the database
            $branch->save();
    
            // Redirect back with success message
            return redirect()->route('branches.index')->with('success', 'Branch created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'Branch Deleted successfully!');
    }
}
