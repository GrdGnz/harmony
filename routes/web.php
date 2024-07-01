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
Route::get('/forms/tro/add-product-with-ticket/{troNumber}', [App\Http\Controllers\TravelRequestOrderController::class, 'addProductWithTicket'])->name('forms.tro.add_product_with_ticket');

//TRO - Search ticket
Route::get('/forms/tro/search-ticket/{troNumber}/{docId}', [App\Http\Controllers\TravelRequestOrderController::class, 'searchTicket'])->name('searchTicket.tro');
Route::get('/inventory/data', [App\Http\Controllers\InventoryController::class, 'getData'])->name('inventory.data');


//Sales Folder
Route::get('/sales-folder/data', [App\Http\Controllers\SalesFolderController::class, 'getData'])->name('sales-folder.data');

//Sales Folder Group
    //Store data
    Route::post('/sales-folder-group/store', [App\Http\Controllers\SalesFolderGroupController::class, 'store'])->name('sales-folder-group.store');
    Route::get('/sales-folder-group/delete/{troNumber}/{docId}', [App\Http\Controllers\SalesFolderGroupController::class, 'delete'])->name('sales-folder-group.delete');
    Route::post('/sales-folder-group/bulk-delete', [App\Http\Controllers\SalesFolderGroupController::class, 'bulkDelete'])->name('sales-folder-group.bulkDelete');
    Route::put('/sales-folder-group/update', [App\Http\Controllers\SalesFolderGroupController::class, 'update'])->name('sales-folder-group.update');

//Sales Folder Hotel
    //Store data
    Route::post('/sales-folder-hotel/store', [App\Http\Controllers\SalesFolderHotelController::class, 'store'])->name('sales-folder-hotel.store');

//Sales Folder Car/Transfer
    //Store data
    Route::post('/sales-folder-transfer/store', [App\Http\Controllers\SalesFolderTransferController::class, 'store'])->name('sales-folder-transfer.store');

//Sales Folder Miscellaneous
    //Store data
    Route::post('/sales-folder-misc/store', [App\Http\Controllers\SalesFolderMiscController::class, 'store'])->name('sales-folder-misc.store');
    //Update data
    Route::put('/sales-folder-misc/update', [App\Http\Controllers\SalesFolderMiscController::class, 'update'])->name('sales-folder-misc.update');

//Sales Folder Air
    //Store temporary data
    Route::post('/sales-folder-air/tempdata/store', [App\Http\Controllers\SalesFolderAirController::class, 'storeTemporaryData'])->name('sales-folder-air.tempdata.store');
    //Store data
    Route::post('/sales-folder-air/store', [App\Http\Controllers\SalesFolderAirController::class, 'store'])->name('sales-folder-air.store');
    //Truncate temporary table of Air itinerary
    Route::post('/truncate-temp-air-data', [App\Http\Controllers\SalesFolderAirController::class, 'truncateTable'])->name('sales-folder-air.tempdata.truncate');
    //Transfer temp data to Sales Folder Air
    Route::post('/transfer-temp-data', [App\Http\Controllers\SalesFolderAirController::class, 'transferData'])->name('sales-folder-air.tempdata.transfer');
    //Update data
    Route::put('/sales-folder-air/update/{sfNo}/{docId}/{itemNo}', [App\Http\Controllers\SalesFolderAirController::class, 'update'])->name('sales-folder-air.update');
    //Delete multiple data
    Route::delete('/sales-folder-air/delete-multiple', [App\Http\Controllers\SalesFolderAirController::class, 'deleteMultiple'])->name('sales-folder-air.deleteMultiple');

//Sales Folder Pax Data
    //Store data
    Route::post('/sales-folder-pax/store', [App\Http\Controllers\SalesFolderPaxController::class, 'store'])->name('sales-folder-pax.store');
    //Store data from ticket
    Route::post('/sales-folder-pax/tempdata/ticket/store', [App\Http\Controllers\TempSalesFolderPaxController::class, 'saveTickets'])->name('sales-folder-pax.tempdata.ticket.store');
    //Store data
    Route::post('/sales-folder-pax/tempdata/pax/store', [App\Http\Controllers\TempSalesFolderPaxController::class, 'savePax'])->name('sales-folder-pax.tempdata.pax.store');
    //Clear data
    Route::post('/sales-folder-pax/tempdata/clear', [App\Http\Controllers\TempSalesFolderPaxController::class, 'truncateTemporaryPaxTable'])->name('sales-folder-pax.tempdata.clear');
    //Transfer temp data to Sales Folder Pax
    Route::post('/transfer-temp-pax-data', [App\Http\Controllers\SalesFolderPaxController::class, 'transferPaxData'])->name('sales-folder-pax.tempdata.transfer');
    //Delete temp pax
    Route::delete('/transfer-temp-pax-data/delete', [App\Http\Controllers\TempSalesFolderPaxController::class, 'deletePax'])->name('sales-folder-pax.tempdata.delete');
    //Update pax count
    Route::post('/get-pax-count', [App\Http\Controllers\TempSalesFolderPaxController::class, 'countTotalPax'])->name('sales-folder-pax.tempdata.count');
    //Update pax data
    Route::put('/sales-folder-pax/update/{sfNo}/{docId}/{itemNo}', [App\Http\Controllers\SalesFolderPaxController::class, 'update'])->name('sales-folder-pax.update');
    //Delete multiple data
    Route::delete('/sales-folder-pax/delete-multiple', [App\Http\Controllers\SalesFolderPaxController::class, 'deleteMultiple'])->name('sales-folder-pax.deleteMultiple');

//Sales Folder Tax
    //Store data
    Route::post('/sales-folder-tax/store', [App\Http\Controllers\SalesFolderTaxController::class, 'store'])->name('sales-folder-tax.store');
    //Store temp tax data
    Route::post('/sales-folder-tax/tempdata/store', [App\Http\Controllers\TempSalesFolderTaxController::class, 'store'])->name('sales-folder-tax.tempdata.store');
    //Delete a temp data
    Route::delete('/sales-folder-tax/tempdata/delete', [App\Http\Controllers\TempSalesFolderTaxController::class, 'destroy'])->name('sales-folder-tax.tempdata.delete');
    //Transfer temp data to Sales Folder Tax
    Route::post('/transfer-temp-tax-data', [App\Http\Controllers\SalesFolderTaxController::class, 'transferTaxData'])->name('sales-folder-tax.tempdata.transfer');
    //Get total taxes
    Route::post('/total-cost-tax-amount', [App\Http\Controllers\TempSalesFolderTaxController::class, 'getTotalTax'])->name('sales-folder-tax.tempdata.total');
    //Delete existing tax data
    Route::delete('/sales-folder-tax/delete', [App\Http\Controllers\SalesFolderTaxController::class, 'destroy'])->name('sales-folder-tax.delete');
    //Delete multiple data
    Route::delete('/sales-folder-tax/delete-multiple', [App\Http\Controllers\SalesFolderTaxController::class, 'deleteMultiple'])->name('sales-folder-tax.deleteMultiple');
    //Success delete
    Route::get('sales-folder-tax/success-delete', function () {
        return redirect()->back()->with('success','Successfully deleted data')->with('deletedTaxRecords', true);
    })->name('sales-folder-tax.successDelete');
