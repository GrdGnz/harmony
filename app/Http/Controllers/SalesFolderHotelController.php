<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesFolderHotel;
use App\Models\SalesFolderGroup;
use Log;

class SalesFolderHotelController extends Controller
{
    public function store(Request $request)
    {
        try {
            $troNumber = $request->input('troNumber');
            $docId = $request->input('docId');

            Log::info('Received troNumber:', ['troNumber' => $troNumber]);

            Log::info('Next DOC_ID:', ['nextDocId' => $docId]);

            Log::info('Request data:', $request->all());

            SalesFolderHotel::create([
                'SF_NO' => $troNumber,
                'DOC_ID' => $docId,
                'HOTEL_CODE' => $request->input('hotelCode'),
                'CHECKIN_DATE' => $request->input('checkInDate'),
                'CHECKOUT_DATE' => $request->input('checkOutDate'),
                'ROOM_TYPE' => $request->input('roomType'),
                'ROOM_CAT' => $request->input('roomCategory'),
                'NIGHT_NO' => $request->input('hotelNights'),
                'STATUS' => $request->input('bookStatus'),
                'GUEST_QTY' => $request->input('numberOfGuest'),
                'ROOM_QTY' => $request->input('roomQuantity'),
                'VIP_FLAG' => $request->has('isVip') ? 1 : 0,
                'MEAL_CODE_1' => $request->input('hotelBreakfast'),
                'MEAL_CODE_2' => $request->input('hotelLunch'),
                'MEAL_CODE_3' => $request->input('hotelDinner'),
                'OTHER_SERVICE' => $request->input('otherServices'),
                'REMARKS' => $request->input('hotelRemarks'),
                'ORIGIN' => 'M',
                'UPDATE_SOURCE' => 'M',
            ]);

            return response()->json([
                'success' => 'Hotel product created successfully!',
                'data' => $request->all(),
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating SalesFolderHotel:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'An error occurred while creating the hotel booking'], 500);
        }
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'sfNo' => 'required|string|max:255',
            'docId' => 'required|string|max:255',
            'hotelCode' => 'required|string|max:255',
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date',
            'hotelNights' => 'nullable|string|max:255',
            'roomType' => 'required|string|max:255',
            'roomCategory' => 'required|string|max:255',
            'bookStatus' => 'required|string|max:255',
            'numberOfGuest' => 'nullable|string|max:255',
            'roomQuantity' => 'nullable|string|max:255',
            'isVip' => 'nullable|string|max:255',
            'hotelBreakfast' => 'nullable|string|max:255',
            'hotelLunch' => 'nullable|string|max:255',
            'hotelDinner' => 'nullable|string|max:255',
            'otherServices' => 'nullable|string|max:255',
            'hotelRemarks' => 'nullable|string|max:255',
        ]);

        try {
                // Find the SalesFolderMisc record by SF_NO and DOC_ID
                $sfHotel = SalesFolderHotel::where('SF_NO', $validatedData['sfNo'])
                                        ->where('DOC_ID', $validatedData['docId'])
                                        ->firstOrFail();

                // Update the record with the validated data
                $sfHotel->update([
                    'HOTEL_CODE' => $request->input('hotelCode'),
                    'CHECKIN_DATE' => $request->input('checkInDate'),
                    'CHECKOUT_DATE' => $request->input('checkOutDate'),
                    'ROOM_TYPE' => $request->input('roomType'),
                    'ROOM_CAT' => $request->input('roomCategory'),
                    'NIGHT_NO' => $request->input('hotelNights'),
                    'STATUS' => $request->input('bookStatus'),
                    'GUEST_QTY' => $request->input('numberOfGuest'),
                    'ROOM_QTY' => $request->input('roomQuantity'),
                    'VIP_FLAG' => $request->has('isVip') ? 1 : 0,
                    'MEAL_CODE_1' => $request->input('hotelBreakfast'),
                    'MEAL_CODE_2' => $request->input('hotelLunch'),
                    'MEAL_CODE_3' => $request->input('hotelDinner'),
                    'OTHER_SERVICE' => $request->input('otherServices'),
                    'REMARKS' => $request->input('hotelRemarks'),
                    'ORIGIN' => 'M',
                    'UPDATE_SOURCE' => 'M',
            ]);

            // Log the update
            Log::info('SalesFolderHotel record updated successfully', ['SF_NO' => $validatedData['sfNo'], 'DOC_ID' => $validatedData['docId'], 'data' => $validatedData]);

            return response()->json(['message' => 'Hotel itinerary updated successfully.'], 200);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating SalesFolderHotel record', ['SF_NO' => $validatedData['sfNo'], 'DOC_ID' => $validatedData['docId'], 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update hotel itinerary. Please try again.'], 500);
        }
    }

}
