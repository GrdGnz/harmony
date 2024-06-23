<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TempSalesFolderTax;
use Log;

class TempSalesFolderTaxController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log the request data
            Log::info('Temp Sales Folder Tax request received', [
                'TAX_CODE' => $request->input('taxCode'),
                'COST_CURR_CODE' => $request->input('taxCostCurrCode'),
                'COST_CURR_RATE' => $request->input('taxCostCurrRate'),
                'COST_AMOUNT' => $request->input('taxCostCurrAmount'),
                'SELL_CURR_CODE' => $request->input('taxSaleCurrCode'),
                'SELL_CURR_RATE' => $request->input('taxSaleCurrRate'),
                'SELL_AMOUNT' => $request->input('taxSaleCurrAmount'),
            ]);

            $tempSalesFolderTax = new TempSalesFolderTax();
            $tempSalesFolderTax->TAX_CODE = $request->input('taxCode');
            $tempSalesFolderTax->TAX_NUM = NULL;
            $tempSalesFolderTax->COST_CURR_CODE = $request->input('taxCostCurrCode');
            $tempSalesFolderTax->COST_CURR_RATE = $request->input('taxCostCurrRate');
            $tempSalesFolderTax->COST_AMOUNT = $request->input('taxCostCurrAmount');
            $tempSalesFolderTax->SELL_CURR_CODE = $request->input('taxSaleCurrCode');
            $tempSalesFolderTax->SELL_CURR_RATE = $request->input('taxSaleCurrRate');
            $tempSalesFolderTax->SELL_AMOUNT = $request->input('taxSaleCurrAmount');
            $tempSalesFolderTax->BILL_FLAG = 'Y';
            $tempSalesFolderTax->INCL_FLAG = 'N';

            if ($tempSalesFolderTax->save()) {
                // Log the success
                Log::info('Temp Sales Folder Tax created successfully');
                $tempData = TempSalesFolderTax::all();
                return response()->json([
                    'success' => 'Tax data successfully added.',
                    'data' => $tempData
                ]);
            } else {
                // Log the error
                Log::error('Failed to create Temp Sales Folder Tax');
                return response()->json(['error' => 'Failed saving tax data.'], 500);
            }
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating Temp Sales Folder Tax: ' . $e->getMessage());
            return response()->json(['error' => 'Failed saving tax data: ' . $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            // Retrieve the tax IDs from the request
            $taxIds = $request->input('taxIds');

            if (empty($taxIds)) {
                return response()->json(['error' => 'No tax data selected for deletion.'], 400);
            }

            // Fetch the records to ensure they exist before attempting deletion
            $taxesToDelete = TempSalesFolderTax::whereIn('id', $taxIds)->get();

            if ($taxesToDelete->isEmpty()) {
                return response()->json(['error' => 'No tax data found for the provided IDs.'], 404);
            }

            // Delete the records
            TempSalesFolderTax::destroy($taxIds);

            // Log the success
            Log::info('Temp Sales Folder Tax deleted successfully', ['taxIds' => $taxIds]);

            // Fetch the updated data
            $tempData = TempSalesFolderTax::all();

            return response()->json([
                'success' => 'Selected tax data successfully deleted.',
                'data' => $tempData
            ]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error deleting Temp Sales Folder Tax: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete selected tax data: ' . $e->getMessage()], 500);
        }
    }


    public function getTotalTax()
    {
        try {
            $totalCostAmount = TempSalesFolderTax::sum('COST_AMOUNT');

            if($totalCostAmount) {
                Log::info('Total tax cost amount: '. $totalCostAmount);

                return response()->json(['totalCostAmount' => $totalCostAmount]);
            } else {
                return response()->json(['totalCostAmount' => 0]);
            }

        } catch(\Exception $e) {
            return response()->json(['totalCostAmount' => 0], 500);
        }
    }

    public function truncateTemporaryTaxTable(Request $request)
    {
        try {
            $troNumber = $request->input('troNumber');

            DB::table('TEMP_SALES_FOLDER_PAX')->truncate();
            Log::info('TEMP_SALES_FOLDER_TAX table truncated.');
            return response()->json([
                'message' => 'TEMP_SALES_FOLDER_TAX table truncated.',
                'redirect_url' => route('forms.tro.add_product', ['troNumber' => $troNumber]),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_TAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error truncating TEMP_SALES_FOLDER_TAX table.'], 500);
        }
    }
}
