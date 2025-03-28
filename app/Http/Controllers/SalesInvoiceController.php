<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Customer;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;
use App\Models\SalesInvoiceItem;

class SalesInvoiceController extends Controller
{
    public function index()
    {
        // $invoices = SalesInvoice::with('items', 'customer', 'creator')->get();
        return view('system.components.sales_invoice.index');
    }

    public function getSkuDetails(Request $request)
    {
        $sku = Sku::with('tax')->where('sku_code', $request->sku_code)
            ->orWhere('sku_name', 'LIKE', '%' . $request->sku_name . '%')
            ->first();

        if ($sku) {
            return response()->json([
                'sku_code' => $sku->sku_code,
                'sku_name' => $sku->sku_name,
                'sales_price' => $sku->sell_price,
                'tax' => optional($sku->tax)->percentage ?? 0, // ✅ Fixed Tax
                'stock' => $sku->current_stock
            ]);
        } else {
            return response()->json(['error' => 'SKU Not Found'], 404);
        }
    }

    // 🔹 Search Customer
    public function searchCustomer(Request $request)
    {
        $query = $request->query('query');

        // Debugging Log
        \Log::info("Search Query: " . $query);

        $customers = Customer::where('shop_name', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        // Debugging Log
        \Log::info("Customers Found: " . json_encode($customers));

        return response()->json($customers);
    }

    // 🔹 Store New Invoice
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'invoice_no'     => 'required|unique:sales_invoices',
    //         'customer_id'    => 'required',
    //         'invoice_date'   => 'required|date',
    //         'sku_codes'      => 'required|array',
    //         'quantities'     => 'required|array',
    //         'sales_prices'   => 'required|array'
    //     ]);

    //     $invoice = SalesInvoice::create([
    //         'invoice_no'        => $request->invoice_no,
    //         'customer_id'       => $request->customer_id,
    //         'invoice_date'      => $request->invoice_date,
    //         'total_quantity'    => array_sum($request->quantities),
    //         'total_amount'      => array_sum($request->net_amounts),
    //         'sub_total'         => array_sum($request->sub_totals),
    //         'total_tax'         => array_sum($request->tax_amounts),
    //         'discount'          => array_sum($request->discount_amounts),
    //         'net_amount'        => array_sum($request->net_amounts),
    //         'instant_discount'  => $request->instant_discount ?? 0,
    //         'transport_cost'    => $request->transport_cost ?? 0,
    //         'remarks'           => $request->remarks,
    //         'created_by'        => auth()->id(),
    //     ]);

    //     foreach ($request->sku_codes as $key => $skuCode) {
    //         SalesInvoiceItem::create([
    //             'sales_invoice_id' => $invoice->id,
    //             'sku_code'         => $skuCode,
    //             'sku_name'         => $request->sku_names[$key],
    //             'quantity'         => $request->quantities[$key],
    //             'sell_price'       => $request->sales_prices[$key],
    //             'discount'         => $request->discounts[$key],
    //             'discount_amount'  => $request->discount_amounts[$key],
    //             'tax'              => $request->taxes[$key],
    //             'tax_amount'       => $request->tax_amounts[$key],
    //             'net_amount'       => $request->net_amounts[$key],
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Invoice Created Successfully!');
    // }



    public function store(Request $request)
{
    // Validate Request
    // $request->validate([
    //     'invoice_no' => 'required|unique:sales_invoices',
    //     'invoice_date' => 'required|date',
    //     'sku_codes' => 'required|array',
    //     'quantities' => 'required|array',
    //     'sales_prices' => 'required|array'
    // ]);

    // Create Sales Invoice
    $invoice = SalesInvoice::create([
        'invoice_no' => $request->invoice_no,
        'customer_id' => $request->customer_id ?? null,
        'invoice_date' => $request->invoice_date,
        'total_quantity' => array_sum($request->quantities ?? []),
        'total_amount' => array_sum($request->net_amounts ?? []),
        'sub_total' => array_sum($request->net_amounts ?? []), // sub_total ঠিক করুন
        'total_tax' => array_sum($request->tax_amounts ?? []),
        'total_discount' => array_sum($request->discount_amounts ?? []),
        'net_amount' => array_sum($request->net_amounts ?? []),
        'instant_discount' => $request->instant_discount ?? 0,
        'transport_cost' => $request->transport_cost ?? 0,
        'remarks' => $request->remarks,
        'created_by' => auth()->id(),
    ]);

    // Insert Invoice Items
    foreach ($request->sku_codes as $key => $skuCode) {
        SalesInvoiceItem::create([
            'sales_invoice_id' => $invoice->id,
            'sku_code' => $skuCode,
            'sku_name' => $request->sku_names[$key] ?? null,
            'quantity' => $request->quantities[$key],
            'current_stock' => $request->current_stocks[$key] ?? 0, // Fix null issue
            'sell_price' => $request->sales_prices[$key],
            'discount' => $request->discounts[$key] ?? 0,
            'discount_amount' => $request->discount_amounts[$key] ?? 0,
            'tax' => $request->taxes[$key] ?? 0,
            'tax_amount' => $request->tax_amounts[$key] ?? 0,
            'net_amount' => $request->net_amounts[$key],
        ]);
    }

    return redirect()->back()->with('success', 'Invoice Created Successfully!');
}




    // public function store(Request $request)
    // {
    //     // Validate Request
    //     // $request->validate([
    //     //     'invoice_no' => 'required|unique:sales_invoices',
    //     //     'customer_id' => 'required|exists:customers,id',
    //     //     'invoice_date' => 'required|date',
    //     //     'sku_ids' => 'required|array',
    //     //     'quantities' => 'required|array',
    //     //     'sales_prices' => 'required|array'
    //     // ]);

    //     // Create Sales Invoice
    //     dd($request->all());
    //     $invoice = SalesInvoice::create([
    //         'invoice_no' => $request->invoice_no,
    //         'customer_id' => $request->customer_id,
    //         'invoice_date' => $request->invoice_date,
    //         'total_quantity' => array_sum($request->quantities ?? []),
    //         'total_amount' => array_sum($request->net_amounts ?? []),
    //         'sub_total' => array_sum($request->sub_totals ?? []),
    //         'total_tax' => array_sum($request->tax_amounts ?? []),
    //         'total_discount' => array_sum($request->discount_amounts ?? []), // Fixed Naming Issue
    //         'net_amount' => array_sum($request->net_amounts ?? []),
    //         'instant_discount' => $request->instant_discount ?? 0,
    //         'transport_cost' => $request->transport_cost ?? 0,
    //         'remarks' => $request->remarks,
    //         'created_by' => auth()->id(),
    //     ]);

    //     // Insert Invoice Items
    //     foreach ($request->sku_code as $key => $skuId) {
    //         SalesInvoiceItem::create([
    //             'sales_invoice_id' => $invoice->id,
    //             'sku_id' => $skuId,
    //             'quantity' => $request->quantities[$key],
    //             'sell_price' => $request->sales_prices[$key],
    //             'discount' => $request->discounts[$key],
    //             'tax' => $request->taxes[$key],
    //             'net_amount' => $request->net_amounts[$key],
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Invoice Created Successfully!');
    // }


    // public function store(Request $request)
    // {
    //     // $request->validate([
    //     //     'invoice_no' => 'required|unique:sales_invoices',
    //     //     'customer_id' => 'required',
    //     //     'invoice_date' => 'required|date',
    //     //     'sku_codes' => 'required|array',
    //     //     'quantities' => 'required|array',
    //     //     'sales_prices' => 'required|array'
    //     // ]);

    //     $invoice = SalesInvoice::create([
    //         'invoice_no' => $request->invoice_no,
    //         'customer_id' => $request->customer_id,
    //         'invoice_date' => $request->invoice_date,
    //         'total_quantity' => array_sum($request->quantities),
    //         'total_amount' => array_sum($request->net_amounts),
    //         'sub_total' => array_sum($request->sub_totals),
    //         'total_tax' => array_sum($request->tax_amounts),
    //         'discount' => array_sum($request->discount_amounts),
    //         'net_amount' => array_sum($request->net_amounts),
    //         'instant_discount' => $request->instant_discount ?? 0,
    //         'transport_cost' => $request->transport_cost ?? 0,
    //         'remarks' => $request->remarks,
    //         'created_by' => auth()->id(),
    //     ]);

    //     foreach ($request->sku_codes as $key => $skuCode) {
    //         SalesInvoiceItem::create([
    //             'sales_invoice_id' => $invoice->id,
    //             'sku_code' => $skuCode,
    //             'sku_name' => $request->sku_names[$key],
    //             'quantity' => $request->quantities[$key],
    //             'sell_price' => $request->sales_prices[$key],
    //             'discount' => $request->discounts[$key],
    //             'discount_amount' => $request->discount_amounts[$key],
    //             'tax' => $request->taxes[$key],
    //             'tax_amount' => $request->tax_amounts[$key],
    //             'net_amount' => $request->net_amounts[$key],
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Invoice Created Successfully!');
    // }












    // 🔹 Update Invoice
    public function update(Request $request, $id)
    {
        $invoice = SalesInvoice::findOrFail($id);
        $invoice->update($request->all());
        return response()->json(['message' => 'Invoice Updated Successfully']);
    }

    // 🔹 Delete Invoice
    public function destroy($id)
    {
        SalesInvoice::destroy($id);
        return response()->json(['message' => 'Invoice Deleted Successfully']);
    }

    // public function getSkuDetails(Request $request)
    // {
    //     $sku = Sku::where('sku_code', $request->sku_code)
    //             ->orWhere('sku_name', $request->sku_name)
    //             ->first();

    //     if ($sku) {
    //         return response()->json([
    //             'sku_code'     => $sku->sku_code,
    //             'sku_name'     => $sku->sku_name,
    //             'sales_price'  => $sku->sell_price,
    //             'tax'          => $sku->tax_id,
    //             'stock'        => $sku->current_stock
    //         ]);
    //     } else {
    //         return response()->json(['error' => 'SKU Not Found'], 404);
    //     }
    // }










}
