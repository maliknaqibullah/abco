<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', \App\Http\Livewire\Dashboard\Dashboard::class)->name('dashboard');
    Route::get('warehouse', \App\Http\Livewire\Warehouse\AddWarehouse::class);
    Route::get('stocks', \App\Http\Livewire\Product\AddProduct::class);
     Route::get('stock-history', \App\Http\Livewire\ListStockHistory::class);
    Route::get('supplier', \App\Http\Livewire\Supplier\AddSupplier::class);
    Route::get('ingredients', \App\Http\Livewire\Ingredient\AddIngredient::class);
    Route::get('schools', \App\Http\Livewire\School\AddSchool::class);
    Route::get('bakeries', \App\Http\Livewire\Bakery\AddBakery::class);
    Route::get('supply-products', \App\Http\Livewire\Bakery\SupplyProduct::class);
    Route::get('warehouse/{id}', \App\Http\Livewire\Warehouse\ShowWarehouse::class);
    Route::get('permissions', \App\Http\Livewire\AddPermission\AddPermission::class);
    Route::get('user-roles', \App\Http\Livewire\Roles\UserRole::class);
    Route::get('transfer-stocks', \App\Http\Livewire\stock\TransferStocks::class);
    Route::get('reports', \App\Http\Livewire\Report\GeneratReport::class);
    Route::get('school-attendance', \App\Http\Livewire\School\AddAttendance::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
});
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
//Route::group(['middleware' => 'auth'], function () {
//    Route::group(['middlewareGroups' => 'role:manager','prefix'=>'manager','as'=>'manager.'], function () {
//    Route::get('warehouse', \App\Http\Livewire\Warehouse\AddWarehouse::class);
//    Route::get('products', \App\Http\Livewire\product\AddProduct::class);
//    Route::get('supplier', \App\Http\Livewire\supplier\AddSupplier::class);
//    Route::get('ingredients', \App\Http\Livewire\ingredient\AddIngredient::class);
//    Route::get('schools', \App\Http\Livewire\school\AddSchool::class);
//    Route::get('bakeries', \App\Http\Livewire\Bakery\AddBakery::class);
//    Route::get('warehouse/{id}', \App\Http\Livewire\Warehouse\ShowWarehouse::class);
//    });
//
//        Route::group(['middlewareGroups' => 'role:admin','prefix'=>'admin','as'=>'admin.'], function () {
//    });
//
//
//
//});
