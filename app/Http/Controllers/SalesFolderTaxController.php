<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class SalesFolderTaxController extends Controller
{
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


}
