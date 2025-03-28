<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\StockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{

    public function getProductBySkuCode($skuCode)
    {
        $sku = Sku::where('sku_code', $skuCode)->first();

        if ($sku) {
            return response()->json([
                'success' => true,
                'product' => [
                    'sku_name' => $sku->sku_name,
                    'sku_code' => $sku->sku_code,
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'SKU not found'], 404);
    }


    public function storeStock(Request $request)
    {
        \Log::info($request->all());



        foreach ($request->sku_code as $key => $sku_code) {


            $sku = Sku::where('sku_code', $sku_code)->first();

            if (!$sku) {
                return response()->json(['success' => false, 'message' => "SKU code '{$sku_code}' not found."]);
            }


            $stock = Stock::create([
                // 'supplier_id' => $request->supplier_id[$key] ?? null,
                // 'supplier_id' => $key == 0 ? $request->supplier_id[$key] : null,
                'supplier_id' => $request->supplier_id[$key] ?? ($key == 0 ? $request->supplier_id[0] : null),
                'sku_id' => $sku->id ?? null,
                'qty' => $request->qty[$key] ?? 0,
                'stock_date' => now(),
                'cost_price' => $request->cost_price[$key] ?? 0,
                'additional_cost' => $request->additional_cost[$key] ?? 0,
                'discount_percent' => $request->discount_percent[$key] ?? 0,
                'remarks' => $request->remarks[$key] ?? null,
                'message' => $request->message[$key] ?? null,
                'created_by' => auth()->id(),
                'status' => 1,
            ]);

            $po_no = $request->po_no ?? str_pad(rand(1000000000000, 9999999999999), 13, '0', STR_PAD_LEFT);
            $grn_no = $request->grn_no ?? str_pad(rand(1000000000000, 9999999999999), 13, '0', STR_PAD_LEFT);

            StockRequest::create([
                'po_no' => $po_no ?? null,
                'grn_no' => $grn_no ?? null,
                'grn_date' => now(),
                'po_date' => now(),
                'total_qty' => $request->qty[$key] ?? 0,
                'total_price' => ($request->qty[$key] * $request->cost_price[$key]) + ($request->additional_cost[$key] ?? 0),
                'total_discount' => $request->discount_percent[$key] ?? 0,
                'total_weight' => $request->total_weight[$key] ?? 0,
                'remarks' => $request->remarks[$key] ?? null,
                'message' => $request->message[$key] ?? null,
                // 'supplier_id' => $request->supplier_id[$key] ?? null,
                'supplier_id' => $key == 0 ? $request->supplier_id[$key] : null,
                'sku_id' => $sku->id ?? null,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Stock and Stock Request added successfully']);
    }


    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('system.components.stock.add_stock', compact('suppliers'));
    }

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
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
