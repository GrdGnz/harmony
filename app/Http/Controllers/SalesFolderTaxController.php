<?php

namespace App\Http\Controllers;

use App\Models\SalesFolderGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SalesFolderTax;
use Log;

class SalesFolderTaxController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'taxCodeNew' => 'required|string',
            'taxCostCurrCodeNew' => 'required|string',
            'taxCostCurrRateNew' => 'required|numeric',
            'taxCostCurrAmountNew' => 'required|numeric',
            'taxSaleCurrCodeNew' => 'required|string',
            'taxSaleCurrRateNew' => 'required|numeric',
            'taxSaleCurrAmountNew' => 'required|numeric',
        ]);

        try {
            // Dynamically calculate ITEM_NO
            $maxItemNo = SalesFolderTax::where('SF_NO', $request->input('sfNo'))
                ->where('DOC_ID', $request->input('docId'))
                ->max('ITEM_NO');
            $nextItemNo = $maxItemNo ? $maxItemNo + 1 : 1;

            // Create a new SalesFolderTax instance
            $salesFolderTax = new SalesFolderTax([
                'SF_NO' => $request->input('sfNo'),
                'DOC_ID' => $request->input('docId'),
                'ITEM_NO' => $nextItemNo,
                'TAX_CODE' => $validatedData['taxCodeNew'],
                'COST_CURR_CODE' => $validatedData['taxCostCurrCodeNew'],
                'COST_CURR_RATE' => $validatedData['taxCostCurrRateNew'],
                'COST_AMOUNT' => $validatedData['taxCostCurrAmountNew'],
                'SELL_CURR_CODE' => $validatedData['taxSaleCurrCodeNew'],
                'SELL_CURR_RATE' => $validatedData['taxSaleCurrRateNew'],
                'SELL_AMOUNT' => $validatedData['taxSaleCurrAmountNew'],
                'UPDATE_SOURCE' => 'M',
                // Include other fields as needed
            ]);

            // Save the SalesFolderTax instance
            $salesFolderTax->save();

            // Log success message
            Log::info('SalesFolderTax record created successfully', [
                'user_id' => auth()->id(),
                'sales_folder_tax_id' => $salesFolderTax->id,
            ]);

            // Optionally, you can redirect or return a response
            return redirect()->back()->with('success', 'Tax data added successfully.')->with('newTaxRecord', true);

        } catch (\Exception $e) {
            // Log error if exception occurs
            Log::error('Error creating SalesFolderTax record: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'request_data' => $validatedData,
                'SF_NO' => $request->input('sfNo'),
                'DOC_ID' => $request->input('docId'),
                'UPDATE_SOURCE' => 'M',
            ]);

            // Handle the exception (e.g., show error message, redirect back)
            return redirect()->back()->with('error', 'Failed to add tax data. Please try again.');
        }
    }

    public function transferTaxData(Request $request)
    {
        DB::beginTransaction();

        try {
            // Get all data from TEMP_SALES_FOLDER_PAX
            $tempData = DB::table('TEMP_SALES_FOLDER_TAX')->get();

            // Get Reference Nos.
            $troNumber = $request->input('troNumber');
            $docId = $request->input('docId');

            // Initialize item number
            $itemNo = 1;

            // Transfer data to SALES_FOLDER_PAX with ORIGIN and UPDATE_SOURCE set to 'M' and ITEM_NO assigned
            foreach ($tempData as $row) {

                DB::table('SALES_FOLDER_TAX')->insert([
                    'SF_NO' => $troNumber,
                    'DOC_ID' => $docId,
                    'ITEM_NO' => $itemNo++,
                    'TAX_CODE' => $row->TAX_CODE,
                    'TAX_NUM' => NULL,
                    'COST_CURR_CODE' => $row->COST_CURR_CODE,
                    'COST_CURR_RATE' => $row->COST_CURR_RATE,
                    'COST_AMOUNT' => $row->COST_AMOUNT,
                    'SELL_CURR_CODE' => $row->COST_CURR_CODE,
                    'SELL_CURR_RATE' => $row->COST_CURR_RATE,
                    'SELL_AMOUNT' => $row->COST_AMOUNT,
                    'BILL_FLAG' => 'Y',
                    'INCL_FLAG' => 'N',
                    'DISC_PERC' => 0,
                    'DISC_AMOUNT' => 0,
                    'REMARKS' => NULL,
                    'ORIGIN' => 'M',
                    'SEL' => 'Y',
                    'UPDATE_SOURCE' => 'M',
                    'COST_COMM_AMOUNT' => 0,
                ]);

            }

            Log::info('Data transferred from TEMP_SALES_FOLDER_TAX to SALES_FOLDER_TAX successfully.');

            // Truncate the TEMP_SALES_FOLDER_PAX table
            DB::table('TEMP_SALES_FOLDER_TAX')->truncate();

            Log::info('TEMP_SALES_FOLDER_TAX table truncated.');

            DB::commit();

            // Return a response
            return response()->json(['message' => 'Data saved and TEMP_SALES_FOLDER_TAX table truncated.']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error transferring data and truncating TEMP_SALES_FOLDER_TAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error saving data.'], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Retrieve the ITEM_NO values from the request
            $itemNos = $request->input('taxIds');
            $sfNo = $request->input('sfNo');
            $docId = $request->input('docId');

            if (empty($itemNos)) {
                return response()->json(['error' => 'No tax data selected for deletion.'], 400);
            }

            // Fetch the records to ensure they exist before attempting deletion
            $taxesToDelete = SalesFolderTax::where('SF_NO', $sfNo)
                ->where('DOC_ID', $docId)
                ->whereIn('ITEM_NO', $itemNos)
                ->get();

            if ($taxesToDelete->isEmpty()) {
                return response()->json(['error' => 'No tax data found for the provided ITEM_NO values.'], 404);
            }

            // Calculate the total cost amount to subtract
            $totalCostAmount = $taxesToDelete->sum('COST_AMOUNT');

            // Delete the records
            SalesFolderTax::where('SF_NO', $sfNo)
                ->where('DOC_ID', $docId)
                ->whereIn('ITEM_NO', $itemNos)
                ->delete();

            // Update the COST_TTAX_AMT field in SalesFolderGroup
            SalesFolderGroup::where('SF_NO', $sfNo)
                ->where('DOC_ID', $docId)
                ->decrement('COST_TTAX_AMT', $totalCostAmount);

            // Log the success
            Log::info('Temp Sales Folder Tax deleted successfully', ['ITEM_NO' => $itemNos, 'COST_AMOUNT' => $totalCostAmount]);

            // Fetch the updated data
            $taxData = SalesFolderTax::all();

            return response()->json([
                'success' => 'Selected tax data successfully deleted.',
                'data' => $taxData
            ]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error deleting Temp Sales Folder Tax: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete selected tax data: ' . $e->getMessage()], 500);
        }
    }

    public function deleteMultiple(Request $request)
    {
        try {
            $records = $request->input('records');

            if (!is_array($records)) {
                Log::error('Invalid input: records are not an array', ['records' => $records]);
                return response()->json(['success' => false, 'message' => 'Invalid input.']);
            }

            Log::info('Received request to delete multiple records', ['records' => $records]);

            // Loop through the records and delete them
            foreach ($records as $record) {
                Log::info('Attempting to delete record', $record);
                SalesFolderTax::where('SF_NO', $record['sfNo'])
                    ->where('DOC_ID', $record['docId'])
                    ->where('ITEM_NO', $record['itemNo'])
                    ->delete();
                Log::info('Successfully deleted record', $record);
            }

            Log::info('All selected records deleted successfully');
            return response()->json(['success' => true, 'message' => 'Records deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error deleting records', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
