<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/clients', [App\Http\Controllers\ClientController::class, 'getClients'])->name('clients');

//TRO
Route::get('/forms/tro', [App\Http\Controllers\TravelRequestOrderController::class, 'index'])->name('forms.tro');
Route::get('/forms/tro/client/{clientId}', [App\Http\Controllers\TravelRequestOrderController::class, 'clientForm'])->name('forms.tro.client');
Route::get('/forms/tro/sf/{troNumber}', [App\Http\Controllers\TravelRequestOrderController::class, 'troForm'])->name('forms.tro.sf');
Route::get('/forms/tro/clients', [App\Http\Controllers\TravelRequestOrderController::class, 'searchClient'])->name('forms.tro.clients');
Route::get('/forms/search/tro', [App\Http\Controllers\TravelRequestOrderController::class, 'searchForm'])->name('searchForm.tro');
Route::post('/add/stock', [App\Http\Controllers\TravelRequestOrderController::class, 'addStock'])->name('add.stocks');

Route::get('/forms/tro/add-product/{troNumber}', [App\Http\Controllers\TravelRequestOrderController::class, 'addProductForm'])->name('forms.tro.add_product');

//Sales Folder
Route::get('/sales-folder/data', [App\Http\Controllers\SalesFolderController::class, 'getData'])->name('sales-folder.data');

//Sales Folder Group
Route::post('/sales-folder-group/store', [App\Http\Controllers\SalesFolderGroupController::class, 'store'])->name('sales-folder-group.store');

//Sales Folder Hotel
Route::post('/sales-folder-hotel/store', [App\Http\Controllers\SalesFolderHotelController::class, 'store'])->name('sales-folder-hotel.store');
