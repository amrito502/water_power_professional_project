<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Tax;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SkuPrice;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SkuDepartment;
use App\Models\SkuSubDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SkuController extends Controller
{
    public function change_price(){
        return view("system.components.sku.change_price");
    }

    public function searchSku(Request $request)
    {
        $sku_code = $request->sku_code;

        // Find the SKU by sku_code
        $sku = Sku::where('sku_code', $sku_code)->first();

        if ($sku) {
            return response()->json([
                'sku' => $sku,
                'message' => 'SKU found!',
            ]);
        } else {
            return response()->json([
                'message' => 'SKU not found!',
            ], 404);
        }
    }


    // public function updatePrice(Request $request)
    // {
    //     // Validate the incoming data
    //     $validated = $request->validate([
    //         'sku_id' => 'required|exists:skus,id',
    //         'cost_price' => 'required|numeric',
    //         'sell_price' => 'required|numeric',
    //     ]);

    //     try {
    //         // Start a database transaction to ensure atomicity
    //         DB::beginTransaction();

    //         // Find SKU and update prices
    //         $sku = Sku::findOrFail($request->sku_id);
    //         $sku->cost_price = $request->cost_price;
    //         $sku->sell_price = $request->sell_price;
    //         $sku->save();

    //         // Update the SKU price record
    //         $skuPrice = new SkuPrice();
    //         $skuPrice->sku_id = $sku->id;
    //         $skuPrice->cost_price = $request->cost_price;
    //         $skuPrice->sell_price = $request->sell_price;
    //         $skuPrice->branch_id = $request->branch_id; // assuming branch_id is in the request
    //         $skuPrice->sku_code = $sku->sku_code;
    //         $skuPrice->status = 1;
    //         $skuPrice->change_date = now();
    //         $skuPrice->save();

    //         // Commit the transaction
    //         DB::commit();

    //         return response()->json([
    //             'message' => 'SKU Price updated successfully!',
    //         ]);
    //     } catch (\Exception $e) {
    //         // Rollback the transaction on error
    //         DB::rollBack();
    //         return response()->json([
    //             'message' => 'An error occurred. Please try again.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    /**
     * Display a listing of the resource.
     */

     public function updatePrice(Request $request)
{
    // Validate the incoming data
    $validated = $request->validate([
        'sku_id' => 'required|exists:skus,id', // Ensures SKU exists
        'cost_price' => 'required|numeric|min:0', // Ensures a valid number
        'sell_price' => 'required|numeric|min:0', // Ensures a valid number
        // 'branch_id' => 'required|exists:branches,id',
    ]);

    try {
        // Start a database transaction to ensure atomicity
        DB::beginTransaction();

        // Find the SKU by ID and update the prices
        $sku = Sku::findOrFail($request->sku_id);
        $sku->cost_price = $request->cost_price;
        $sku->sell_price = $request->sell_price;
        $sku->save();

        // Save the price change to the SKU price table
        $skuPrice = new SkuPrice();
        $skuPrice->sku_id = $sku->id;
        $skuPrice->cost_price = $request->cost_price;
        $skuPrice->sell_price = $request->sell_price;
        $skuPrice->branch_id = 4;
        $skuPrice->sku_code = $sku->sku_code;
        $skuPrice->status = 1;
        $skuPrice->change_date = now();
        $skuPrice->save();

        // Commit the transaction
        DB::commit();

        // Respond with a success message
        return response()->json([
            'message' => 'SKU Price updated successfully!',
        ]);
    } catch (\Exception $e) {
        // Rollback the transaction on error
        DB::rollBack();

        // Log the error for debugging purposes
        \Log::error('Error updating SKU Price: ' . $e->getMessage());

        // Respond with an error message
        return response()->json([
            'message' => 'An error occurred. Please try again.',
            'error' => $e->getMessage(),
        ], 500);
    }
}
    public function index()
    {
          // Fetch all SKUs along with their related data
        $skus = Sku::with(['department', 'subDepartment', 'category', 'brand', 'supplier', 'tax'])->get();

        return view('system.components.sku.index',compact('skus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch the departments
        $skuDepartments = SkuDepartment::all();

        // Fetch the sub-departments for each department
        $skuSubDepartments = SkuSubDepartment::all();

        // Fetch the categories
        $categories = Category::all();

        // You can also fetch brands, suppliers, and taxes if needed
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $taxes = Tax::all();

        return view('system.components.sku.create', compact('skuDepartments', 'skuSubDepartments', 'categories', 'brands', 'suppliers', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $sku_code = $request->sku_code ?? str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $bar_code = $request->bar_code ?? str_pad(rand(1000000000000, 9999999999999), 13, '0', STR_PAD_LEFT);

        $sku = new Sku();
        $sku->sku_code = $sku_code;
        $sku->bar_code = $bar_code;
        $sku->sku_name = $request->sku_name;
        $sku->cost_price = $request->cost_price ?? 0.00;
        $sku->sell_price = $request->sell_price ?? 0.00;

        $sku->sku_department_id = $request->sku_department_id;
        $sku->sku_sub_department_id = $request->sku_sub_department_id;

        $sku->categorie_id = $request->categorie_id;
        $sku->brand_id = $request->brand_id;
        $sku->supplier_id = $request->supplier_id ?? 0;
        $sku->tax_id = $request->tax_id;
        $sku->user_id = auth()->user()->id;
        $sku->status = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/sku/images');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $sku->image = 'uploads/sku/images/' . $imageName;
        }

        $sku->negative_stock = $request->negative_stock ?? 'no';
        $sku->is_weighted = $request->is_weighted ?? 'no';
        $sku->case_count = $request->case_count;
        $sku->is_ecommerce = $request->is_ecommerce ?? 2;
        $sku->is_featured = $request->is_featured ?? 2;
        $sku->is_sales = $request->is_sales ?? 2;
        $sku->is_parent = $request->is_parent ?? 2;
        $sku->specification = $request->specification;
        $sku->shipping_payment = $request->shipping_payment;
        $sku->description = $request->description;

        $sku->rank = $request->rank ?? 5;

        $sku->save();

        return redirect()->route('skus.index')->with('success', 'SKU created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sku $sku)
    {
        return view('system.components.sku.show', compact('sku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sku $sku)
    {
        // Fetch the SKU by ID
        //   $sku = Sku::findOrFail($id);

        // Fetch the departments, sub-departments, and categories
        $skuDepartments = SkuDepartment::all();
        // $skuSubDepartments = SkuSubDepartment::where('sku_department_id', $sku->sku_department_id)->get();
        $skuSubDepartments = SkuSubDepartment::all();
        $categories = Category::all();

        // Fetch other related data
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $taxes = Tax::all();

        return view('system.components.sku.edit', compact('sku', 'skuDepartments', 'skuSubDepartments', 'categories', 'brands', 'suppliers', 'taxes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sku $sku)
    {
        // Validate the request
        // $request->validate([
        //     'sku_code' => 'required|string|max:150',
        //     'bar_code' => 'nullable|string|max:150',
        //     'sku_name' => 'nullable|string|max:200',
        //     'cost_price' => 'nullable|numeric',
        //     'sell_price' => 'nullable|numeric',
        //     'sku_department_id' => 'nullable|exists:sku_departments,id',
        //     'sku_sub_department_id' => 'nullable|exists:sku_sub_departments,id',
        //     'categorie_id' => 'nullable|exists:categories,id',
        //     'brand_id' => 'nullable|exists:brands,id',
        //     'supplier_id' => 'nullable|exists:suppliers,id',
        //     'tax_id' => 'nullable|exists:taxes,id',
        //     'image' => 'nullable|image',
        // ]);

        // Find the SKU
        // $sku = Sku::findOrFail($id);
        $sku_code = $request->sku_code ?? str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $bar_code = $request->bar_code ?? str_pad(rand(1000000000000, 9999999999999), 13, '0', STR_PAD_LEFT);

        // Update the SKU details
        $sku->sku_code = $request->sku_code ?? $sku_code;
        $sku->bar_code = $request->bar_code ?? $bar_code;
        $sku->sku_name = $request->sku_name ?? $sku->sku_name;
        $sku->cost_price = $request->cost_price ?? $sku->cost_price;
        $sku->sell_price = $request->sell_price ?? $sku->sell_price;
        $sku->sku_department_id = $request->sku_department_id ?? $sku->sku_department_id;
        $sku->sku_sub_department_id = $request->sku_sub_department_id ?? $sku->sku_sub_department_id;
        $sku->categorie_id = $request->categorie_id ?? $sku->categorie_id;
        $sku->brand_id = $request->brand_id ?? $sku->brand_id;
        $sku->supplier_id = $request->supplier_id ?? $sku->supplier_id;
        $sku->tax_id = $request->tax_id ?? $sku->tax_id;
        $sku->user_id = auth()->user()->id; // Assuming user is logged in
        $sku->status = $request->status ?? $sku->status;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/sku/images');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $sku->image = 'uploads/sku/images/' . $imageName;
        }

        // Save the changes to the SKU
        $sku->save();

        // Redirect back with success message
        return redirect()->route('skus.index')->with('success', 'SKU updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sku $sku)
    {
          // If the SKU has an associated image, delete it from the file system
          if ($sku->image && File::exists(public_path($sku->image))) {
            File::delete(public_path($sku->image));
        }

        // Delete the SKU
        $sku->delete();

        // Redirect back with a success message
        return redirect()->route('skus.index')->with('success', 'SKU deleted successfully!');
    }



    public function getSubDepartments($departmentId)
    {
        $subDepartments = SkuSubDepartment::where('sku_department_id', $departmentId)->get();

        // Return a JSON response
        return response()->json($subDepartments);
    }

    // Fetch categories based on sub-department ID
    public function getCategories($subDepartmentId)
    {
        $categories = Category::where('sku_sub_department_id', $subDepartmentId)->get();

        // Return a JSON response
        return response()->json($categories);
    }


    public function sku_search_page(){
        return view("system.components.sku.search_product");
    }

    public function sku_search(Request $request)
    {
        $query = $request->input('query');

        $results = Sku::where('sku_name', 'LIKE', "%$query%")
        ->get();

        // $results = Product::with('images')
        // ->where('itemName', 'LIKE', "%$query%")
        // ->get();

        return response()->json($results);
    }


}
