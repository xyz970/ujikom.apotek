<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\SaleController as CustomerSaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineFormTypeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\MustAdminMiddleware;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;


Route::get('/',[CustomerAuthController::class,'login'])->name('customer.login');
Route::get('customer/signup',[CustomerAuthController::class,'signUp'])->name('customer.signup');
Route::post('customer/login_process',[CustomerAuthController::class,'loginProcess'])->name('customer.login_process');
Route::post('customer/signup_process',[CustomerAuthController::class,'signUpProcess'])->name('customer.signup_process');
Route::get('customer/logout',[CustomerAuthController::class,'logout'])->name('customer.logout');
Route::resource('customer', CustomerSaleController::class)->middleware(CustomerMiddleware::class);


Route::prefix('admin')->middleware(AdminMiddleware::class)->name('admin.')->group(function(){
    Route::get('login',[AuthController::class,'index'])->name('login_page')->withoutMiddleware([AdminMiddleware::class]);
    Route::post('login/process',[AuthController::class,'loginProcess'])->name('login.process')->withoutMiddleware([AdminMiddleware::class]);
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::resource('city',CityController::class)->withoutMiddleware([AdminMiddleware::class]);

    Route::resource('administrator_user',AdministratorController::class)->middleware(MustAdminMiddleware::class);
    
    Route::get('medicine/data',[MedicineController::class,'data'])->name('medicine.data')->withoutMiddleware([AdminMiddleware::class]);
    Route::resource('purchase',PurchaseController::class)->middleware(MustAdminMiddleware::class);
    
    Route::get('supplier/data',[SupplierController::class,'data'])->name('supplier.data')->middleware(MustAdminMiddleware::class);;
    Route::resource('supplier',SupplierController::class)->middleware(MustAdminMiddleware::class);
    
    Route::get('customer/data',[CustomerController::class,'data'])->name('customer.data')->middleware(MustAdminMiddleware::class);;
    Route::resource('customer',CustomerController::class)->middleware(MustAdminMiddleware::class);
    
    Route::get('medicine_form_type/data',[MedicineFormTypeController::class,'data'])->name('medicine_form_type.data')->middleware(MustAdminMiddleware::class);;
    Route::resource('medicine_form_type',MedicineFormTypeController::class)->middleware(MustAdminMiddleware::class);
    
    Route::resource('medicine',MedicineController::class);
    Route::get('sale/export',[SaleController::class,'export'])->name('sale.export');
    Route::resource('sale',SaleController::class);

    


});
