<?php

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ShareHolderController;
use App\Http\Controllers\SalesInvoiceController;
use App\Http\Controllers\StockRequestController;
use App\Http\Controllers\DamageWastageController;
use App\Http\Controllers\SkuDepartmentController;
use App\Http\Controllers\SkuSubDepartmentController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');






Route::get('/permissions/index', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::post('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');


Route::get('/roles/index', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
// Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/destroy', [RoleController::class, 'destroy'])->name(name: 'roles.destroy');

// Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
// Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
// Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
// Route::delete('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

Route::resource('branches', BranchController::class);
Route::resource('companies', CompanyController::class);
Route::resource('zones', ZoneController::class);

Route::resource('departments', DepartmentController::class);
Route::resource('designations', DesignationController::class);
Route::resource('shifts', ShiftController::class);
Route::resource('employees', EmployeeController::class);
Route::get('/export-employees', [EmployeeController::class, 'exportEmployees'])->name('export.employees');
Route::resource('suppliers', SupplierController::class);
Route::resource('taxes', TaxController::class);
Route::resource('brands', BrandController::class);
Route::resource('sku_departments', SkuDepartmentController::class);
Route::resource('sku_sub_departments', SkuSubDepartmentController::class);
Route::resource('categories', CategoryController::class);
Route::resource('skus', SkuController::class);
Route::get('/get-sub-departments/{departmentId}', [SkuController::class, 'getSubDepartments'])->name('get.sub.departments');
Route::get('/get-categories/{subDepartmentId}', [SkuController::class, 'getCategories'])->name('get.categories');

Route::get('/change-sku-price',[SkuController::class,'change_price'])->name('change.sku.price');
Route::post('/sku/search', [SkuController::class, 'searchSku']);
Route::post('/sku/update-price', [SkuController::class, 'updatePrice']);
Route::get('/sku/search-page', [SkuController::class, 'sku_search_page'])->name('sku.search.page');
Route::get('/sku/search', [SkuController::class, 'sku_search'])->name('sku_search');


Route::get('/get-product/{sku_code}', [StockController::class, 'getProductBySkuCode']);
Route::post('/add-stock', [StockController::class, 'storeStock']);

Route::resource('stocks', StockController::class);

Route::get('/stock-requests', [StockRequestController::class, 'index'])->name('stock_requests.index');
Route::post('/stock-requests/approve', [StockRequestController::class, 'approve'])->name('stock_requests.approve');

Route::get('/stock-requests-show', [StockRequestController::class, 'stock_req_show'])->name('stock-requests.show');
Route::get('/stock-requests/get/{grn_no}', [StockRequestController::class, 'getByGrn'])->name('stock-requests.getByGrn');
// Route::post('/stock-requests/update', [StockRequestController::class, 'updateStockRequests'])->name('stock-requests.update');
// Route::post('/stock-requests/update/', [StockRequestController::class, 'updateStockRequests'])->name('stock-requests.update');
// web.php (Routes)
Route::post('/stock-requests/update', [StockRequestController::class, 'updateStockRequest']);



Route::resource('damagewastages', DamageWastageController::class);
Route::get('/get-product', [DamageWastageController::class, 'getProductBySku'])->name('getProductBySku');


Route::resource('customers', CustomerController::class);
Route::resource('shareholders', ShareHolderController::class);


// Route::get('/invoices', [SalesInvoiceController::class, 'index'])->name('invoices.index');
// Route::get('/invoices/{id}', [SalesInvoiceController::class, 'show'])->name('invoices.show');
// Route::post('/invoices', [SalesInvoiceController::class, 'store'])->name('invoices.store');
// Route::put('/invoices/{id}', [SalesInvoiceController::class, 'update'])->name('invoices.update');
// Route::delete('/invoices/{id}', [SalesInvoiceController::class, 'destroy'])->name('invoices.destroy');

Route::resource('sales_invoices', SalesInvoiceController::class);


Route::get('/get-sku-details', [SalesInvoiceController::class, 'getSkuDetails'])->name('getSkuDetails');
Route::get('/search-customer', [SalesInvoiceController::class, 'searchCustomer'])->name('searchCustomer');
Route::post('/store-invoice', [SalesInvoiceController::class, 'store'])->name('storeInvoice');
Route::put('/update-invoice/{id}', [SalesInvoiceController::class, 'update'])->name('updateInvoice');
Route::delete('/delete-invoice/{id}', [SalesInvoiceController::class, 'destroy'])->name('deleteInvoice');



















Route::post('/waterpower_logout', [AuthController::class, 'waterpower_logout'])->name('waterpower_logout');


Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('waterpower_dashboard');
Route::get('/company', [DashboardController::class, 'company'])->name('company');
Route::get('/company/create', [DashboardController::class, 'company_create'])->name('company.create');


Route::get('/users', [AuthController::class, 'users'])->name('users');
Route::get('/users/create', [AuthController::class, 'users_create'])->name('users.create');
Route::post('/users/store', [AuthController::class, 'users_store'])->name('users.store');

Route::get('/pos/users/edit/{id}', [AuthController::class, 'users_edit'])->name('users.edit');
Route::post('/pos/users/update/{id}', [AuthController::class, 'users_update'])->name('users.update');
Route::delete('/pos/users/delete/{id}', [AuthController::class, 'users_delete'])->name('users.delete');


});









Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/login/store', [AuthController::class, 'login_store'])->name('login.store');






require __DIR__ . '/auth.php';
