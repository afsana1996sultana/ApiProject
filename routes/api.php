<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\API\IncomeCategoryController;
use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\UnitController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\LeaveController;
use App\Http\Controllers\API\ShiftController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\DepositController;
use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\HolidayController;
use App\Http\Controllers\API\PayrollController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\PurchaseController;
// use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\VariationController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\SaleReturnController;
use App\Http\Controllers\API\TaskTargetController;
use App\Http\Controllers\API\DesignationController;
use App\Http\Controllers\API\LeaveManageController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\PurchaseReturnController;
use App\Http\Controllers\API\CourierShippingController;
use App\Http\Controllers\API\ExpenseCategoryController;
use App\Http\Controllers\API\PurchasePaymentController;
use App\Http\Controllers\API\PathaoCourierApiController;
use App\Http\Controllers\API\SaleReturnPaymentController;
use App\Http\Controllers\API\VariationTemplateController;
use App\Http\Controllers\API\SupplierTransactionController;
use App\Http\Controllers\API\PurchasePaymentReturnController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\StaffController;
use App\Http\Controllers\API\SearchFilterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']);
    Route::post('update/{id}', [RegisterController::class, 'update']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {

    // admin roles
    Route::get('get_roles', [\App\Http\Controllers\API\RoleController::class, 'index'])->name('user.role');
    Route::get('get_permissions', [\App\Http\Controllers\API\RoleController::class, 'permission'])->name('user.permission');
    Route::post('store/role_permission', [\App\Http\Controllers\API\RoleController::class, 'store'])->name('role.permission');
    Route::get('role_permission/{id}', [\App\Http\Controllers\API\RoleController::class, 'edit'])->name('role_permission');
    Route::put('update_role_permission/{id}', [\App\Http\Controllers\API\RoleController::class, 'update'])->name('update_role_permission');

    // admin user module
    Route::get('user/list', [\App\Http\Controllers\API\UserController::class, 'allUser'])->name('admin.user');
    Route::get('user/role', [\App\Http\Controllers\API\UserController::class, 'get_role'])->name('all_role');
    Route::post('user/store', [\App\Http\Controllers\API\UserController::class, 'storeAdminUser'])->name('admin.user.store');
    Route::get('user/edit/{id}', [\App\Http\Controllers\API\UserController::class, 'editAdminUser'])->name('admin.user.edit');
    Route::put('user/update/{id}', [\App\Http\Controllers\API\UserController::class, 'updateAdminUser'])->name('admin.user.update');
    Route::post('user/profile/update', [\App\Http\Controllers\API\UserController::class, 'profileUpdate']);
    Route::post('user/profile/password-change', [\App\Http\Controllers\API\UserController::class, 'profilePasswordChange']);

    Route::apiResource('account', AccountController::class);
    Route::apiResource('attendance', AttendanceController::class);
    Route::apiResource('branches', BranchController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::get('get-category', [CategoryController::class, 'getAllCategories']);
    Route::apiResource('courier-shipping', CourierShippingController::class);
    Route::apiResource('dashboard', DashboardController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('deposit', DepositController::class);
    Route::apiResource('designations', DesignationController::class);
    Route::apiResource('employee', EmployeeController::class);
    Route::apiResource('expense-categories', ExpenseCategoryController::class);
    Route::apiResource('expense', ExpenseController::class);
    Route::apiResource('holiday', HolidayController::class);
    Route::apiResource('income-categories', IncomeCategoryController::class);
    Route::apiResource('income', IncomeController::class);
    Route::apiResource('leave', LeaveController::class);
    Route::apiResource('leave-manage', LeaveManageController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('payroll', PayrollController::class);
    Route::apiResource('purchase', PurchaseController::class);
    Route::post('purchase/due-payment/{id}', [PurchaseController::class, 'purchaseDuePayment']);
    Route::apiResource('purchase-return', PurchaseReturnController::class);
    Route::apiResource('purchase-payment', PurchasePaymentController::class);
    Route::apiResource('purchase-payment-return', PurchasePaymentReturnController::class);
    Route::apiResource('sale', SaleController::class);
    Route::get('sale-index-header-total', [SaleController::class, 'indexHeaderTotal']);
    Route::post('sale/update/{id}', [SaleController::class, 'update']);
    Route::post('sale/status/change/{sale_id}', [SaleController::class, 'saleStatusChange']);
    Route::get('sale/dispatch/list', [SaleController::class, 'saleDispatchList']);
    Route::post('sale/dispatch-status/change/{id}', [SaleController::class, 'saleDispatchStatusChange']);
    Route::get('sale/barcode-scan/{invoice_number}', [SaleController::class, 'barcodeScan']);
    Route::post('sale/due-payment/{sale_id}', [SaleController::class, 'saleDuePayment']);
    Route::get('sale/reschedule/list', [SaleController::class, 'saleReschedule']);
    Route::get('sale/reschedule/show/{id}', [SaleController::class, 'saleRescheduleShow']);
    Route::post('sale/reschedule/{sale_id}', [SaleController::class, 'saleRescheduleStore']);
    Route::post('sale/reschedule/update/{id}', [SaleController::class, 'saleRescheduleUpdate']);
    Route::post('sale/reschedule-process/{sale_id}', [SaleController::class, 'saleRescheduleProcess']);
    Route::post('sale/report/filter', [SaleController::class, 'saleReportDateFilter']);
    Route::apiResource('sale-return', SaleReturnController::class);
    Route::apiResource('sale-return-payment', SaleReturnPaymentController::class);
    Route::apiResource('setting', SettingController::class);
    Route::apiResource('shift', ShiftController::class);
    Route::apiResource('transaction', TransactionController::class);
    Route::apiResource('task-targets', TaskTargetController::class);
    Route::apiResource('units', UnitController::class);
    Route::apiResource('variation-templates', VariationTemplateController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::get('supplier/transaction', [SupplierTransactionController::class, 'supplierTransaction']);
    Route::post('supplier/transaction/store', [SupplierTransactionController::class, 'supplierTransactionStore']);
    Route::get('supplier/transaction/show/{id}', [SupplierTransactionController::class, 'supplierTransactionShow']);
    Route::post('supplier/transaction/due-payment/{st_id}', [SupplierTransactionController::class, 'supplierTransactionDuePayment']);
    Route::get('supplier/transaction/all-payment/{supplier_id}', [SupplierTransactionController::class, 'supplierTransactionAllPayment']);
    Route::get('supplier/transaction/payment/show/{stp_id}', [SupplierTransactionController::class, 'supplierTransactionPaymentShow']);
    Route::post('supplier/transaction/payment/update/{stp_id}', [SupplierTransactionController::class, 'supplierTransactionPaymentUpdate']);
    Route::delete('supplier/transaction/payment/delete/{stp_id}', [SupplierTransactionController::class, 'supplierTransactionPaymentDelete']);
    Route::resource('customers', CustomerController::class);
    Route::get('all-variations', [VariationController::class, 'allVariations']);
    Route::get('paginate-variations', [VariationController::class, 'paginateVariations']);
    Route::get('customer-list', [CustomerController::class, 'customerList']);

    /*
    |--------------------------------------------------------------------------
    | Report, Search, Filter : Routes
    |--------------------------------------------------------------------------
    */
    Route::get('report/{model}', [ReportController::class, 'report']);
    Route::get('search/{keyword}', [SearchFilterController::class, 'search']);
    Route::get('search/{keyword}', [SearchFilterController::class, 'search']);
    Route::get('show-entries/{number}', [SearchFilterController::class, 'showEntries']);
    Route::get('date-filters/{model}', [SearchFilterController::class, 'dateFilters']);
    Route::get('csv-download/{model}', [SearchFilterController::class, 'csvDownload']);

    /*
    |--------------------------------------------------------------------------
    | Pathao Courier API
    |--------------------------------------------------------------------------
    */
    Route::get('get-city', [PathaoCourierApiController::class, 'getCities']);
    Route::get('get-zone/{city_id}', [PathaoCourierApiController::class, 'getZones']);
    Route::get('get-area/{zone_id}', [PathaoCourierApiController::class, 'getAreas']);


    Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'my-account', 'as' => 'my-account.'], function () {
        //write admin api
    });
});
