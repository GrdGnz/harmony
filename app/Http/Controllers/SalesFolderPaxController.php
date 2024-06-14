<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use Log;

class SalesFolderPaxController extends Controller
{
    public function storeTemporaryData(Request $request)
    {
        try {
            // Validate the request data if needed

            // Insert data into the TEMP_SALES_FOLDER_PAX table
            DB::table('TEMP_SALES_FOLDER_PAX')->insert([
                'SF_NO' => $request->input('troNumber'),
                'DOC_ID' => $request->input('docId'),
                'PROD_CAT' => $request->input('productCategory'),
                'PNR' => $request->input('passengerPNR'),
                'PAX_NAME' => $request->input('passengerName'),
                'TICKET_NO' => $request->input('passengerTicketNumber'),
            ]);

            Log::info('Data inserted into TEMP_SALES_FOLDER_PAX table successfully.');

            // Retrieve all data from the TEMP_SALES_FOLDER_AIR table
            $tempData = DB::table('TEMP_SALES_FOLDER_PAX')->get();

            Log::info('Retrieved data from TEMP_SALES_FOLDER_PAX table: ' . json_encode($tempData));

            // Return a response
            return response()->json(['message' => 'Passenger added successfully!', 'data' => $tempData]);
        } catch (\Exception $e) {
            Log::error('Error inserting data into TEMP_SALES_FOLDER_PAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding Passenger'], 500);
        }
    }


    public function transferPaxData(Request $request)
    {
        DB::beginTransaction();

        try {
            // Get all data from TEMP_SALES_FOLDER_PAX
            $tempData = DB::table('TEMP_SALES_FOLDER_PAX')->get();

            // Get product category
            $productCategory = $request->input('productCategory');

            // Initialize item number
            $itemNo = 1;

            // Array to store ticket numbers
            $ticketNumbers = [];

            // Transfer data to SALES_FOLDER_PAX with ORIGIN and UPDATE_SOURCE set to 'M' and ITEM_NO assigned
            foreach ($tempData as $row) {
                $docflag = ($row->PROD_CAT === 'A') ? 'N' : 'Y';

                DB::table('SALES_FOLDER_PAX')->insert([
                    'SF_NO' => $row->SF_NO,
                    'DOC_ID' => $row->DOC_ID,
                    'ITEM_NO' => $itemNo++,
                    'PROD_CAT' => $productCategory,
                    'DOC_FLAG' => $docflag,
                    'PAX_NAME' => $row->PAX_NAME,
                    'PAX_ID' => -1,
                    'TICKET_NO' => $row->TICKET_NO,
                    'CONJUNCT_COUNT' => 0,
                    'CAV_NO' => NULL,
                    'SELL_BAL_AMT' => 0.00,
                    'COST_BAL_AMT' => 0.00,
                    'CASH_INV_CNT' => 0,
                    'CREDIT_INV_CNT' => 0,
                    'CHARGE_INV_CNT' => 0,
                    'UATP_INV_CNT' => 0,
                    'PASSPORT_NUMBER' => NULL,
                    'PASSPORT_ISSUE' => NULL,
                    'PASSPORT_EXPIRY' => NULL,
                    'VISA_NO' => NULL,
                    'VISA_ISSUE' => NULL,
                    'VISA_EXPIRY' => NULL,
                    'NATIONALITY' => NULL,
                    'REMARKS' => NULL,
                    'ORIGIN' => 'M',
                    'SEL' => 'Y',
                    'UPDATE_SOURCE' => 'M',
                    'OEC' => NULL,
                    'OEC_DATE' => NULL,
                    'PNR' => $row->PNR,
                    'GDS_PROVIDER' => NULL,
                    'DUE_DATE' => now()->format('Y-m-d'),
                ]);

                // Collect ticket numbers for updating Inventory
                $ticketNumbers[] = $row->TICKET_NO;
            }

            Log::info('Data transferred from TEMP_SALES_FOLDER_PAX to SALES_FOLDER_PAX successfully.');

            // Truncate the TEMP_SALES_FOLDER_PAX table
            DB::table('TEMP_SALES_FOLDER_PAX')->truncate();

            Log::info('TEMP_SALES_FOLDER_PAX table truncated.');

            // Update the Inventory table where TICKET_NO is in the collected ticket numbers
            if (!empty($ticketNumbers)) {
                Inventory::whereIn('TICKET_NO', $ticketNumbers)->update(['SF_NO' => $row->SF_NO]);
                Log::info('Inventory records updated with new SF_NO.', ['SF_NO' => $row->SF_NO, 'ticketNumbers' => $ticketNumbers]);
            }

            DB::commit();

            // Return a response
            return response()->json(['message' => 'Data saved and TEMP_SALES_FOLDER_PAX table truncated.']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error transferring data and truncating TEMP_SALES_FOLDER_PAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error saving data.'], 500);
        }
    }

}
