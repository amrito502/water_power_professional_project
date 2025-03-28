<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Sku;
use App\Models\StockRequest;
use Illuminate\Http\Request;
use App\Models\DamageWastage;
use Illuminate\Support\Facades\DB;

class DamageWastageController extends Controller
{



    public function getProductBySku(Request $request)
    {

        $sku = $request->input('sku_code');
        $sku = Sku::where('sku_code', $sku)->first();

        if ($sku) {
            $stockRequest = StockRequest::where('sku_id', $sku->id)->first();
            $totalQty = $stockRequest ? $stockRequest->total_qty : 0;

            return response()->json([
                'success' => true,
                'sku' => $sku,
                'current_stock' => $totalQty,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sku not found'
            ]);
        }

    }







    public function store(Request $request)
    {
        $request->validate([
            'dw_no' => 'required|string',
            'type' => 'required|integer',
            'branch_id' => 'required|integer',
            'dam_date' => 'required|date',
            'data' => 'required|array',
            'data.*.sku_code' => 'required|string',
            'data.*.qty' => 'required|numeric',
            'data.*.current_stock' => 'required|numeric',
            'data.*.cost_price' => 'required|numeric',
            'data.*.net_amount' => 'required|numeric',
            'data.*.sku_id' => 'required|integer',
        ]);

        $data = $request->input('data');
        $dw_no = $request->input('dw_no');
        $type = $request->input('type');
        $branch_id = $request->input('branch_id');
        $dam_date = $request->input('dam_date');

        if (empty($data)) {
            return response()->json(['message' => 'No Damage/Wastage data provided'], 400);
        }

        \DB::beginTransaction();

        try {
            foreach ($data as $item) {
                $damageWastage = DamageWastage::create([
                    'dw_no' => $dw_no,
                    'type' => $type,
                    'branch_id' => $branch_id,
                    'dam_date' => $dam_date,
                    'qty' => $item['qty'],
                    'cost_price' => $item['cost_price'],
                    'total_amount' => $item['net_amount'],
                    'sku_id' => $item['sku_id'],
                ]);

                $stockRequest = StockRequest::where('sku_id', $item['sku_id'])

                    ->first();

                if ($stockRequest) {
                    \Log::info('Stock found for SKU: ' . $item['sku_code'] . ' | Current stock: ' . $stockRequest->total_qty);

                    if ($stockRequest->total_qty >= $item['qty']) {
                        $newStockQuantity = $stockRequest->total_qty - $item['qty'];
                        $stockRequest->update([
                            'total_qty' => $newStockQuantity,
                        ]);
                    } else {
                        return response()->json([
                            'message' => 'Not enough stock for SKU: ' . $item['sku_code'],
                        ], 400);
                    }
                } else {
                    \Log::error('Stock request not found for SKU: ' . $item['sku_code']);
                    return response()->json([
                        'message' => 'Stock request not found for SKU: ' . $item['sku_code']
                    ], 404);
                }
            }

            \DB::commit();

            return response()->json(['message' => 'Damage/Wastage saved successfully!']);
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error saving Damage/Wastage: ' . $e->getMessage());

            return response()->json(['message' => 'Error occurred while saving data!', 'error' => $e->getMessage()], 500);
        }
    }








    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branches = Branch::all();
        return view('system.components.damageWastage.index', compact('branches'));
    }


    




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skus = Sku::all();

        return view('system.components.damageWastage.create', compact('skus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/DamageWastageController.php

    /**
     * Display the specified resource.
     */
    public function show(DamageWastage $damageWastage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DamageWastage $damageWastage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DamageWastage $damageWastage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DamageWastage $damageWastage)
    {
        //
    }
}
