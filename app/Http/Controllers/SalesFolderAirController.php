<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;

use Illuminate\Database\Schema\Blueprint;
use App\Models\SalesFolderAir;

class SalesFolderAirController extends Controller
{
    public function store(Request $request)
    {
        try {
            $itemNo = DB::table('SALES_FOLDER_AIR')
                        ->where('SF_NO', $request->sfNo)
                        ->where('DOC_ID', $request->docId)
                        ->max('ITEM_NO') + 1;

            $newRecord = [
                'SF_NO' => $request->sfNo,
                'DOC_ID' => $request->docId,
                'ITEM_NO' => $itemNo,
                'AL_CODE' => $request->airlineNew,
                'FLIGHT_NUM' => $request->flightNumberNew,
                'DEPT_CITY' => $request->departureCityNew,
                'DEPT_DATE' => $request->departureDateNew,
                'DEPT_TIME' => $request->departureTimeNew,
                'ARVL_CITY' => $request->arrivalCityNew,
                'ARVL_DATE' => $request->arrivalDateNew,
                'ARVL_TIME' => $request->arrivalTimeNew,
                'SERVICE_CLASS' => $request->serviceClassNew,
                'ORIGIN' => 'M',
                'UPDATE_SOURCE' => 'M',
            ];

            DB::table('SALES_FOLDER_AIR')->insert($newRecord);

            Log::info('New record added to SALES_FOLDER_AIR', $newRecord);

            return redirect()->back()->with('success','Successfully added data')->with('newRecord', true);

        } catch (\Exception $e) {
            Log::error('Error adding new record to SALES_FOLDER_AIR', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error','Failed to add new record');
        }
    }

    public function storeTemporaryData(Request $request)
    {
        try {
            // Validate the request data if needed

            // Insert data into the TEMP_SALES_FOLDER_AIR table
            DB::table('TEMP_SALES_FOLDER_AIR')->insert([
                'SF_NO' => $request->input('troNumber'),
                'DOC_ID' => $request->input('docId'),
                'AL_CODE' => $request->input('airline'),
                'FLIGHT_NUM' => $request->input('flightNumber'),
                'SERVICE_CLASS' => $request->input('serviceClass'),
                'DEPT_CITY' => $request->input('departureCity'),
                'DEPT_DATE' => $request->input('departureDate'),
                'DEPT_TIME' => $request->input('departureTime'),
                'ARVL_CITY' => $request->input('arrivalCity'),
                'ARVL_DATE' => $request->input('arrivalDate'),
                'ARVL_TIME' => $request->input('arrivalTime'),
            ]);

            Log::info('Data inserted into TEMP_SALES_FOLDER_AIR table successfully.');

            // Retrieve all data from the TEMP_SALES_FOLDER_AIR table
            $tempData = DB::table('TEMP_SALES_FOLDER_AIR')->get();

            Log::info('Retrieved data from TEMP_SALES_FOLDER_AIR table: ' . json_encode($tempData));

            // Return a response
            return response()->json(['message' => 'Air product created successfully!', 'data' => $tempData]);
        } catch (\Exception $e) {
            Log::error('Error inserting data into TEMP_SALES_FOLDER_AIR table: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding Air Segment'], 500);
        }
    }


    public function transferData()
    {
        try {
            // Get all data from TEMP_SALES_FOLDER_AIR
            $tempData = DB::table('TEMP_SALES_FOLDER_AIR')->get();

            // Initialize item number
            $itemNo = 1;

            // Transfer data to SALES_FOLDER_AIR with ORIGIN and UPDATE_SOURCE set to 'M' and ITEM_NO assigned
            foreach ($tempData as $row) {
                DB::table('SALES_FOLDER_AIR')->insert([
                    'SF_NO' => $row->SF_NO,
                    'DOC_ID' => $row->DOC_ID,
                    'ITEM_NO' => $itemNo++,
                    'AL_CODE' => $row->AL_CODE,
                    'FLIGHT_NUM' => $row->FLIGHT_NUM,
                    'DEPT_CITY' => $row->DEPT_CITY,
                    'DEPT_DATE' => $row->DEPT_DATE,
                    'DEPT_TIME' => NULL,
                    'ARVL_CITY' => $row->ARVL_CITY,
                    'ARVL_DATE' => $row->ARVL_DATE,
                    'ARVL_TIME' => NULL,
                    'SERVICE_CLASS' => $row->SERVICE_CLASS,
                    'ORIGIN' => 'M',
                    'UPDATE_SOURCE' => 'M',
                ]);
            }

            Log::info('Data transferred from TEMP_SALES_FOLDER_AIR to SALES_FOLDER_AIR successfully.');

            // Truncate the TEMP_SALES_FOLDER_AIR table
            DB::table('TEMP_SALES_FOLDER_AIR')->truncate();

            Log::info('TEMP_SALES_FOLDER_AIR table truncated.');

            // Return a response
            return response()->json(['message' => 'Data saved and TEMP_SALES_FOLDER_AIR table truncated.']);
        } catch (\Exception $e) {
            Log::error('Error transferring data and truncating TEMP_SALES_FOLDER_AIR table: ' . $e->getMessage());
            return response()->json(['message' => 'Error saving data.'], 500);
        }
    }



    public function truncateTable()
    {
        try {
            DB::table('TEMP_SALES_FOLDER_AIR')->truncate();
            Log::info('TEMP_SALES_FOLDER_AIR table truncated.');
            return redirect()->back()->with('message','Itinerary has been cleared.')->with('clearedAirItinerary', true);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_AIR table: ' . $e->getMessage());
            return redirect()->back()->with('error','Clear itinerary failed.');
        }
    }

    public function update(Request $request, $sfNo, $docId, $itemNo)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'airline' => 'required|string|max:255',
            'flightNumber' => 'required|string|max:50',
            'serviceClass' => 'required|string|max:50',
            'departureCity' => 'nullable|string|max:255',
            'departureDate' => 'nullable|date',
            'departureTime' => 'nullable|string|max:50',
            'arrivalCity' => 'nullable|string|max:255',
            'arrivalDate' => 'nullable|date',
            'arrivalTime' => 'nullable|string|max:50',
        ]);

        try {
            // Update the SalesFolderAir record using raw SQL query
            $affected = DB::update('UPDATE SALES_FOLDER_AIR SET
                                    AL_CODE = ?,
                                    FLIGHT_NUM = ?,
                                    SERVICE_CLASS = ?,
                                    DEPT_CITY = ?,
                                    DEPT_DATE = ?,
                                    DEPT_TIME = ?,
                                    ARVL_CITY = ?,
                                    ARVL_DATE = ?,
                                    ARVL_TIME = ?
                                    WHERE SF_NO = ? AND DOC_ID = ? AND ITEM_NO = ?',
                                    [
                                        $validatedData['airline'],
                                        $validatedData['flightNumber'],
                                        $validatedData['serviceClass'],
                                        $validatedData['departureCity'],
                                        $validatedData['departureDate'],
                                        $validatedData['departureTime'],
                                        $validatedData['arrivalCity'],
                                        $validatedData['arrivalDate'],
                                        $validatedData['arrivalTime'],
                                        $sfNo,
                                        $docId,
                                        $itemNo
                                    ]);

            Log::info('Update data: ' . $affected);

            // Check if any record was updated
            if ($affected > 0) {
                // Log the update
                Log::info('SalesFolderAir record updated: SF_NO = ' . $sfNo . ', DOC_ID = ' . $docId . ', ITEM_NO = ' . $itemNo);

                return response()->json(['success' => 'Record updated successfully.']);
            } else {
                return response()->json(['error' => 'No record found or updated.'], 404);
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating SalesFolderAir record: ' . $e->getMessage());

            return response()->json(['error' => 'Error updating record: ' . $e->getMessage()], 500);
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
                SalesFolderAir::where('SF_NO', $record['sfNo'])
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
