<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['companies'] = Company::all();
        return view('system.components.company.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('system.components.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:150',
            'domain' => 'required|string|max:150',
            'email' => 'required|string|email|max:150',
            'favicon' => 'required',
            'logo' => 'nullable',
            'theme' => 'nullable|string|max:150',
            'skin' => 'nullable|string|max:150',
            'detailsinfo' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        $companies = new Company();
        $companies->packageId = $request->packageId ?? 1;
        $companies->orgIdPrefix = $request->orgIdPrefix ?? 'SBC';
        $companies->name = $request->name ?? 'N/A';
        $companies->domain = $request->domain ?? 'N/A';
        $companies->email = $request->email ?? 'N/A';
        $companies->theme = $request->theme ?? 'waterpowerbrand';
        $companies->skin = $request->skin ?? 'N/A';
        $companies->detailsinfo = $request->detailsinfo ?? 'N/A';
        $companies->status = $request->status;

        // favicon
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/company/favicon');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $companies->favicon = 'uploads/company/favicon/' . $imageName;
        }


        // logo
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/company/logo');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $companies->logo = 'uploads/company/logo/' . $imageName;
        }

        $companies->save();

        return redirect()->back()->with('success','Company successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $data["company"]  = $company;
        return view('system.components.company.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'nullable|string|max:150',
            'domain' => 'required|string|max:150',
            'email' => 'required|string|email|max:150',
            'status' => 'nullable|integer',
        ]);

       
        $company->packageId = $request->packageId ?? 1;
        $company->orgIdPrefix = $request->orgIdPrefix ?? 'SBC';
        $company->name = $request->name ?? 'N/A';
        $company->domain = $request->domain ?? 'N/A';
        $company->email = $request->email ?? 'N/A';
        $company->theme = $request->theme ?? 'waterpowerbrand';
        $company->skin = $request->skin ?? 'N/A';
        $company->detailsinfo = $request->detailsinfo ?? 'N/A';
        $company->status = $request->status;

        if ($company->favicon && File::exists(public_path($company->favicon))) {
            File::delete(public_path($company->favicon));
        }

        if ($company->logo && File::exists(public_path($company->logo))) {
            File::delete(public_path($company->logo));
        }

        // favicon
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/company/favicon');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $company->favicon = 'uploads/company/favicon/' . $imageName;
        }


        // logo
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/company/logo');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $company->logo = 'uploads/company/logo/' . $imageName;
        }

        $company->save();

        return redirect()->back()->with('success','Company successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->favicon && File::exists(public_path($company->favicon))) {
            File::delete(public_path($company->favicon));
        }

        if ($company->logo && File::exists(public_path($company->logo))) {
            File::delete(public_path($company->logo));
        }

        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
