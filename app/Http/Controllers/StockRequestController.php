<?php

namespace App\Http\Controllers;

use App\Models\StockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockRequests = StockRequest::where('status', 0)->with('supplier', 'sku')->get();
        return view('system.components.stock.add_request_stock', compact('stockRequests'));
    }

    public function approve(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:stock_requests,id',
        ]);

        StockRequest::whereIn('id', $request->ids)->update(['status' => 1]);

        return redirect()->route('stock_requests.index')->with('success', 'Stock requests approved successfully.');
    }





    public function stock_req_show(Request $request){
        return view('system.components.stock.request_stock_update_page');

    }

    public function getByGrn($grn_no)
    {
        $stockRequests = StockRequest::where('grn_no', $grn_no)
            ->with('sku') // Load related SKU data
            ->get();

            return response()->json($stockRequests);
    }


  // StockRequestController.php
public function updateStockRequest(Request $request)
{
    try {
        // Loop through stock requests and update
        foreach ($request->stock_requests as $data) {
            $stockRequest = StockRequest::find($data['id']);

            if (!$stockRequest) {
                return response()->json(['error' => 'Stock request not found'], 404);
            }

            // Calculate necessary fields
            $costPrice = $stockRequest->sku->cost_price; // Assuming the cost price is related to the SKU

            $totalAmount = $data['total_qty'] * $costPrice;
            $discAmount = ($data['disc_percent'] / 100) * $totalAmount;
            $grandTotal = $totalAmount - $discAmount;

            // Update stock request
            $stockRequest->update([
                'total_qty' => $data['total_qty'],
                'disc_percent' => $data['disc_percent'],
                'total_price' => $totalAmount,
                'total_discount' => $discAmount,
                'grand_total' => $grandTotal
            ]);
        }

        // Return success message
        return response()->json(['message' => 'Stock request updated successfully']);
    } catch (\Exception $e) {
        // Return error details in the response
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
}







    /**
     * Show the form for creating a new resource.
     */







    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StockRequest $stockRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockRequest $stockRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, StockRequest $stockRequest)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockRequest $stockRequest)
    {
        //
    }
}
