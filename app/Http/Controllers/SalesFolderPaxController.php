<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\SalesFolderPax;
use Log;

class SalesFolderPaxController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'passengerName' => 'required|string|max:255',
            'passengerPNR' => 'required|string|max:255',
            'passengerTicketNumber' => 'required|string|max:255',
            'productCategory' => 'required|string|max:255',
        ]);

        try {
            // Log the entire request for debugging
            Log::info('SalesFolderPax store method called', ['request' => $request->all()]);

            $sfNo = $request->input('sf_no');
            $docId = $request->input('doc_id');
            $productCategory = $validatedData['productCategory'];

            // Fetch the last ITEM_NO for the given SF_NO and DOC_ID
            $lastItem = SalesFolderPax::where('SF_NO', $sfNo)
                ->where('DOC_ID', $docId)
                ->orderByDesc('ITEM_NO')
                ->first();

            $nextItemNo = $lastItem ? $lastItem->ITEM_NO + 1 : 1;

            $docflag = ($productCategory === 'A') ? 'N' : 'Y';

            // Prepare the data for insertion
            $data = [
                'SF_NO' => $sfNo,
                'DOC_ID' => $docId,
                'ITEM_NO' => $nextItemNo,
                'PROD_CAT' => $validatedData['productCategory'],
                'DOC_FLAG' => $docflag,
                'PAX_NAME' => strtoupper($validatedData['passengerName']),
                'PAX_ID' => -1,
                'TICKET_NO' => $validatedData['passengerTicketNumber'],
                'CONJUNCT_COUNT' => 0,
                'CAV_NO' => null,
                'SELL_BAL_AMT' => 0.00,
                'COST_BAL_AMT' => 0.00,
                'CASH_INV_CNT' => 0,
                'CREDIT_INV_CNT' => 0,
                'CHARGE_INV_CNT' => 0,
                'UATP_INV_CNT' => 0,
                'PASSPORT_NUMBER' => null,
                'PASSPORT_ISSUE' => null,
                'PASSPORT_EXPIRY' => null,
                'VISA_NO' => null,
                'VISA_ISSUE' => null,
                'VISA_EXPIRY' => null,
                'NATIONALITY' => null,
                'REMARKS' => null,
                'ORIGIN' => 'M',
                'SEL' => 'Y',
                'UPDATE_SOURCE' => 'M',
                'OEC' => null,
                'OEC_DATE' => null,
                'PNR' => strtoupper($validatedData['passengerPNR']),
                'GDS_PROVIDER' => null,
                'DUE_DATE' => \Carbon\Carbon::now()->format('Y-m-d'),
            ];

            // Insert the data into the database
            DB::table('SALES_FOLDER_PAX')->insert($data);

            Log::info('New passenger added', ['passenger' => $data]);

            $allPax = SalesFolderPax::where('SF_NO', $sfNo)
                ->where('DOC_ID', $docId)
                ->get();

            // Count the total number of passengers
            $totalCount = $allPax->count();

            return response()->json([
                'message' => 'Passenger added successfully',
                'data' => $allPax,
                'totalCount' => $totalCount
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error adding new passenger', ['message' => $e->getMessage()]);

            return response()->json(['message' => 'An error occurred while adding the passenger. Please try again.'], 500);
        }
    }


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

    public function update(Request $request, $sfNo, $docId, $itemNo)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'paxName' => 'required|string|max:255',
            'ticketNo' => 'required|string|max:50',
            'pnr' => 'required|string|max:50',
        ]);

        try {
            // Update the SalesFolderPax record using raw SQL query
            $affected = DB::update('UPDATE SALES_FOLDER_PAX SET
                                    PAX_NAME = ?,
                                    TICKET_NO = ?,
                                    PNR = ?
                                    WHERE SF_NO = ? AND DOC_ID = ? AND ITEM_NO = ?',
                                    [
                                        $validatedData['paxName'],
                                        $validatedData['ticketNo'],
                                        $validatedData['pnr'],
                                        $sfNo,
                                        $docId,
                                        $itemNo
                                    ]);

            // Check if any record was updated
            if ($affected > 0) {
                // Log the update
                Log::info('SalesFolderPax record updated: SF_NO = ' . $sfNo . ', DOC_ID = ' . $docId . ', ITEM_NO = ' . $itemNo);

                return response()->json(['success' => 'Record updated successfully.']);
            } else {
                return response()->json(['error' => 'No record found or updated.'], 404);
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating SalesFolderPax record: ' . $e->getMessage());

            return response()->json(['error' => 'Error updating record: ' . $e->getMessage()], 500);
        }
    }

    public function deleteMultiple(Request $request)
    {
        $idsToDelete = $request->input('ids');
        $sfNo = $request->input('sfNo');
        $docId = $request->input('docId');

        if ($idsToDelete) {
            Log::info('Starting to delete multiple records', ['ids' => $idsToDelete]);

            try {
                foreach ($idsToDelete as $id) {
                    SalesFolderPax::where('SF_NO', $id['sf_no'])
                                  ->where('DOC_ID', $id['doc_id'])
                                  ->where('ITEM_NO', $id['item_no'])
                                  ->delete();

                    Log::info('Deleted record', ['sf_no' => $id['sf_no'], 'doc_id' => $id['doc_id'], 'item_no' => $id['item_no']]);
                }

                Log::info('Finished deleting multiple records');

                $allPax = SalesFolderPax::where('SF_NO', $sfNo)
                    ->where('DOC_ID', $docId)
                    ->get();

                // Count the total number of passengers
                $totalCount = $allPax->count();

                return response()->json([
                    'success' => 'Selected records deleted successfully',
                    'totalCount' => $totalCount
                ]);
            } catch (\Exception $e) {
                Log::error('Error deleting records', ['error' => $e->getMessage()]);

                return response()->json(['error' => 'An error occurred while deleting the records'], 500);
            }
        } else {
            Log::warning('No records selected for deletion');

            return response()->json(['error' => 'No records selected'], 400);
        }
    }

}
