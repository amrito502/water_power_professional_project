<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SkuSubDepartment;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('subDepartment')->get();
        return view('system.components.categories.index', compact('categories'));
    }

    public function create()
    {
        $subDepartments = SkuSubDepartment::all();
        return view('system.components.categories.create', compact('subDepartments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku_sub_department_id' => 'nullable|exists:sku_sub_departments,id',
            'name' => 'required|string|max:50',
            'status' => 'required|integer',
            'rank' => 'required|integer'
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $subDepartments = SkuSubDepartment::all();
        return view('system.components.categories.edit', compact('category', 'subDepartments'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'sku_sub_department_id' => 'nullable|exists:sku_sub_departments,id',
            'name' => 'required|string|max:50',
            'status' => 'required|integer',
            // 'rank' => 'required|integer'
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
