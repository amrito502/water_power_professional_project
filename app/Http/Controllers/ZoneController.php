<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Branch;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = Zone::all();
        return view('system.components.zone.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('system.components.zone.create',compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Validate the request data
          $request->validate([
            'branch_id' => 'nullable|exists:branches,id', // Ensure the branch exists
            'name' => 'nullable|string|max:255',
            'addressline' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:150',
            'postalcode' => 'nullable|string|max:150',
            'phone' => 'nullable|string|max:155',
            'fax' => 'nullable|string|max:155',
            'email' => 'nullable|email|max:155',
            'status' => 'nullable|integer',
        ]);

        // Create a new Zone and assign the form values
        $zone = new Zone();
        $zone->branch_id = $request->branch_id;
        $zone->name = $request->name ?? 'N/A';
        $zone->addressline = $request->addressline ?? 'N/A';
        $zone->city = $request->city ?? 'N/A';
        $zone->postalcode = $request->postalcode ?? 'N/A';
        $zone->phone = $request->phone ?? 'N/A';
        $zone->fax = $request->fax ?? 'N/A';
        $zone->email = $request->email ?? 'N/A';
        $zone->vatrn = $request->vatrn ?? 'N/A';
        $zone->status = $request->status;
        $zone->save();

        // Redirect or return response
        return redirect()->route('zones.index')->with('success', 'Zone created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {
        $branches = Branch::all();
        return view('system.components.zone.edit',compact('zone','branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'addressline' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:150',
            'phone' => 'nullable|string|max:155',
            'email' => 'nullable|email|max:155',
            'status' => 'nullable|integer',
        ]);

        // Create a new Zone and assign the form values
        $zone->branch_id = $request->branch_id;
        $zone->name = $request->name ?? 'N/A';
        $zone->addressline = $request->addressline ?? 'N/A';
        $zone->city = $request->city ?? 'N/A';
        $zone->postalcode = $request->postalcode ?? 'N/A';
        $zone->phone = $request->phone ?? 'N/A';
        $zone->fax = $request->fax ?? 'N/A';
        $zone->email = $request->email ?? 'N/A';
        $zone->vatrn = $request->vatrn ?? 'N/A';
        $zone->status = $request->status;
        $zone->save();

        // Redirect or return response
        return redirect()->route('zones.index')->with('success', 'Zone Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zone Deleted successfully!');
    }
}
