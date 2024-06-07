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
Route::get('/details/product/{troNumber}/{docId}', [App\Http\Controllers\TravelRequestOrderController::class, 'productDetails'])->name('details.product');
Route::post('/add/stock', [App\Http\Controllers\TravelRequestOrderController::class, 'addStock'])->name('add.stocks');

//TRO - Add product
Route::get('/forms/tro/add-product/{troNumber}', [App\Http\Controllers\TravelRequestOrderController::class, 'addProductForm'])->name('forms.tro.add_product');

//TRO - Search ticket
Route::get('/forms/tro/search-ticket/{troNumber}/{docId}', [App\Http\Controllers\TravelRequestOrderController::class, 'searchTicket'])->name('searchTicket.tro');
Route::get('/inventory/data', [App\Http\Controllers\InventoryController::class, 'getData'])->name('inventory.data');


//Sales Folder
Route::get('/sales-folder/data', [App\Http\Controllers\SalesFolderController::class, 'getData'])->name('sales-folder.data');

//Sales Folder Group
    //Store data
    Route::post('/sales-folder-group/store', [App\Http\Controllers\SalesFolderGroupController::class, 'store'])->name('sales-folder-group.store');

//Sales Folder Hotel
    //Store data
    Route::post('/sales-folder-hotel/store', [App\Http\Controllers\SalesFolderHotelController::class, 'store'])->name('sales-folder-hotel.store');

//Sales Folder Car/Transfer
    //Store data
    Route::post('/sales-folder-transfer/store', [App\Http\Controllers\SalesFolderTransferController::class, 'store'])->name('sales-folder-transfer.store');

//Sales Folder Miscellaneous
    //Store data
    Route::post('/sales-folder-misc/store', [App\Http\Controllers\SalesFolderMiscController::class, 'store'])->name('sales-folder-misc.store');

//Sales Folder Air
    //Store data
    Route::post('/sales-folder-air/tempdata/store', [App\Http\Controllers\SalesFolderAirController::class, 'storeTemporaryData'])->name('sales-folder-air.tempdata.store');
    //Truncate temporary table of Air itinerary
    Route::post('/truncate-temp-air-data', [App\Http\Controllers\SalesFolderAirController::class, 'truncateTable'])->name('sales-folder-air.tempdata.truncate');
    //Transfer temp data to Sales Folder Air
    Route::post('/transfer-temp-data', [App\Http\Controllers\SalesFolderAirController::class, 'transferData'])->name('sales-folder-air.tempdata.transfer');
    //Update data
    Route::put('/sales-folder-air/update/{sfNo}/{docId}/{itemNo}', [App\Http\Controllers\SalesFolderAirController::class, 'update'])->name('sales-folder-air.update');

//Transfer Pax Data
    //Store data
    Route::post('/sales-folder-pax/tempdata/store', [App\Http\Controllers\TempSalesFolderPaxController::class, 'saveTickets'])->name('sales-folder-pax.tempdata.store');
    //Transfer temp data to Sales Folder Air
    Route::post('/transfer-temp-pax-data', [App\Http\Controllers\SalesFolderPaxController::class, 'transferPaxData'])->name('sales-folder-pax.tempdata.transfer');
