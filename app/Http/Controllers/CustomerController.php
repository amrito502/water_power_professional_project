<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('system.components.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'customer_code' => 'nullable|string|max:150',
        //     'shop_name' => 'nullable|string|max:150',
        //     'full_name' => 'nullable|string|max:255',
        //     'gender' => 'nullable|string|max:10',
        //     'address' => 'nullable|string|max:255',
        //     'postal_code' => 'nullable|string',
        //     'thana' => 'nullable|string|max:15',
        //     'city' => 'nullable|string|max:150',
        //     'phone' => 'nullable|string|max:155',
        //     'email' => 'nullable|email|max:155',
        //     'v_card' => 'nullable|string|max:150',
        //     'date_of_birth' => 'nullable|date',
        //     'opening_balance' => 'nullable|numeric',
        //     'status' => 'nullable|integer',
        // ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('system.components.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('system.components.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // $request->validate([
        //     'customer_code' => 'nullable|string|max:150',
        //     'shop_name' => 'nullable|string|max:150',
        //     'full_name' => 'nullable|string|max:255',
        //     'gender' => 'nullable|string|max:10',
        //     'address' => 'nullable|string|max:255',
        //     'postal_code' => 'nullable|string|max:5',
        //     'thana' => 'nullable|string|max:15',
        //     'city' => 'nullable|string|max:150',
        //     'phone' => 'nullable|string|max:155',
        //     'email' => 'nullable|email|max:155',
        //     'v_card' => 'nullable|string|max:150',
        //     'date_of_birth' => 'nullable|date',
        //     'opening_balance' => 'nullable|numeric',
        //     'status' => 'nullable|integer',
        // ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
