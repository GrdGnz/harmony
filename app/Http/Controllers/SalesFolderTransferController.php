<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesFolderTransfer;
use Log;

class SalesFolderTransferController extends Controller
{
    public function store(Request $request)
    {
        try {
            $troNumber = $request->input('troNumber');
            $docId = $request->input('docId');

            Log::info('Received troNumber:', ['troNumber' => $troNumber]);

            Log::info('Next DOC_ID:', ['nextDocId' => $docId]);

            Log::info('Request data:', $request->all());

            SalesFolderTransfer::create([
                'SF_NO' => $troNumber,
                'DOC_ID' => $docId,
                'CAR_PROVIDER' => $request->input('carProvider'),
                'CAR_TYPE' => $request->input('carType'),
                'CAR_CAT' => $request->input('carCategory'),
                'MOVE_TYPE' => 'A',
                'CITY_CODE' => NULL,
                'MOVE_TIME' => NULL,
                'FLIGHT_NUM' => $request->input('carFlightNumber'),
                'PICK_DATE' => $request->input('pickUpDate'),
                'PICK_TIME' => $request->input('pickUpTime'),
                'PICK_LOC' => $request->input('pickUpLocation'),
                'DROP_DATE' => $request->input('dropoffDate'),
                'DROP_TIME' => $request->input('dropoffTime'),
                'DROP_LOC' => $request->input('dropoffLocation'),
                'VIP_FLAG' => 'N',
                'STOP_OVER_1' => $request->input('stopoverFirst'),
                'STOP_OVER_2' => $request->input('stopoverSecond'),
                'STOP_OVER_3' => $request->input('stopoverThird'),
                'PHONE_NO' => $request->input('pickupPhoneNumber'),
                'MOBILE_NO' => NULL,
                'EMAIL' => NULL,
                'SPECIAL_REQUEST' => $request->input('carSpecialRequest'),
                'STATUS' => $request->input('carStatus'),
                'ORIGIN' => 'M',
                'UPDATE_SOURCE' => 'M',
            ]);

            return response()->json([
                'success' => 'Car/Transfer product created successfully!',
                'data' => $request->all(),
            ]);

        } catch(\Exception $e) {
            Log::error('Error creating SalesFolderTransfer:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'An error occurred while creating the car/transfer sales folder'], 500);
        }
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'sfNo' => 'required|string|max:255',
            'docId' => 'required|string|max:255',
            'carProvider' => 'required|string|max:255',
            'carType' => 'required|string|max:255',
            'carCategory' => 'nullable|string|max:255',
            'carFlightNumber' => 'nullable|string|max:255',
            'pickUpDate' => 'nullable|date',
            'pickUpTime' => 'nullable|string|max:255',
            'pickUpLocation' => 'nullable|string|max:255',
            'dropoffDate' => 'nullable|date',
            'dropoffTime' => 'nullable|string|max:255',
            'dropoffLocation' => 'nullable|string|max:255',
            'stopoverFirst' => 'nullable|string|max:255',
            'stopoverSecond' => 'nullable|string|max:255',
            'stopoverThird' => 'nullable|string|max:255',
            'pickupPhoneNumber' => 'nullable|string|max:255',
            'carSpecialRequest' => 'nullable|string|max:255',
            'carStatus' => 'nullable|string|max:255',
        ]);

        try {
                // Find the SalesFolderMisc record by SF_NO and DOC_ID
                $sfTransfer = SalesFolderTransfer::where('SF_NO', $validatedData['sfNo'])
                                        ->where('DOC_ID', $validatedData['docId'])
                                        ->firstOrFail();

                // Update the record with the validated data
                $sfTransfer->update([
                    'CAR_PROVIDER' => $request->input('carProvider'),
                    'CAR_TYPE' => $request->input('carType'),
                    'CAR_CAT' => $request->input('carCategory'),
                    'MOVE_TYPE' => 'A',
                    'CITY_CODE' => NULL,
                    'MOVE_TIME' => NULL,
                    'FLIGHT_NUM' => $request->input('carFlightNumber'),
                    'PICK_DATE' => $request->input('pickUpDate'),
                    'PICK_TIME' => $request->input('pickUpTime'),
                    'PICK_LOC' => $request->input('pickUpLocation'),
                    'DROP_DATE' => $request->input('dropoffDate'),
                    'DROP_TIME' => $request->input('dropoffTime'),
                    'DROP_LOC' => $request->input('dropoffLocation'),
                    'VIP_FLAG' => 'N',
                    'STOP_OVER_1' => $request->input('stopoverFirst'),
                    'STOP_OVER_2' => $request->input('stopoverSecond'),
                    'STOP_OVER_3' => $request->input('stopoverThird'),
                    'PHONE_NO' => $request->input('pickupPhoneNumber'),
                    'MOBILE_NO' => NULL,
                    'EMAIL' => NULL,
                    'SPECIAL_REQUEST' => $request->input('carSpecialRequest'),
                    'STATUS' => $request->input('carStatus'),
                    'ORIGIN' => 'M',
                    'UPDATE_SOURCE' => 'M',
            ]);

            // Log the update
            Log::info('SalesFolderTransfer record updated successfully', ['SF_NO' => $validatedData['sfNo'], 'DOC_ID' => $validatedData['docId'], 'data' => $validatedData]);

            return response()->json(['message' => 'Car/Transfer itinerary updated successfully.'], 200);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating SalesFolderTransfer record', ['SF_NO' => $validatedData['sfNo'], 'DOC_ID' => $validatedData['docId'], 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update car/transfer itinerary. Please try again.'], 500);
        }
    }
}
