<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('system.components.shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shift_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'break_duration' => 'nullable|integer|min:0',
            'recurrence' => 'nullable|string|in:daily,weekly,custom',
            'applicable_days' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
        ], [
            'start_time.required' => 'The start time is required.',
            'start_time.date_format' => 'The start time must be in HH:MM format.',
            'end_time.required' => 'The end time is required.',
            'end_time.date_format' => 'The end time must be in HH:MM format.',
            'end_time.after' => 'The end time must be after the start time.',
            'break_duration.integer' => 'The break duration must be an integer.',
            'break_duration.min' => 'The break duration must be a positive number.',
            'recurrence.in' => 'The recurrence must be one of: daily, weekly, custom.',
            'status.in' => 'The status must be either 0 or 1.',
        ]);


        Shift::create($request->all());

        return redirect()->route('shifts.index')->with('success', 'Shift created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        return view('system.components.shift.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {


        $shift->update($request->all());

        return redirect()->route('shifts.index')->with('success', 'Shift updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->route('shifts.index')->with('success', 'Shift deleted successfully!');
    }
}
