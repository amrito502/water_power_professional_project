<?php

namespace App\Http\Controllers;

use App\Models\ShareHolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareHolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shareholders = Shareholder::with('creator')->get();
        return view('system.components.shareholders.index', compact('shareholders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.shareholders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'addressline' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'sharePercent' => 'nullable|integer|max:100',
            'opening_balance' => 'nullable|numeric',
            'status' => 'nullable|integer|in:0,1',
        ]);

        Shareholder::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'addressline' => $request->addressline,
            'city' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
            'sharePercent' => $request->sharePercent,
            'opening_balance' => $request->opening_balance,
            'status' => $request->status,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('shareholders.index')->with('success', 'Shareholder created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShareHolder $shareholder)
    {

        return view('system.components.shareholders.show', compact('shareholder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShareHolder $shareholder)
    {

        return view('system.components.shareholders.edit', compact('shareholder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShareHolder $shareHolder)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'addressline' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'sharePercent' => 'nullable|integer|max:100',
            'opening_balance' => 'nullable|numeric',
            'status' => 'nullable|integer|in:0,1',
        ]);


        $shareHolder->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'addressline' => $request->addressline,
            'city' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
            'sharePercent' => $request->sharePercent,
            'opening_balance' => $request->opening_balance,
            'status' => $request->status,
        ]);

        return redirect()->route('shareholders.index')->with('success', 'Shareholder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShareHolder $shareHolder)
    {
        $shareHolder->delete();
        return redirect()->route('shareholders.index')->with('success', 'Shareholder deleted successfully.');
    }
}
