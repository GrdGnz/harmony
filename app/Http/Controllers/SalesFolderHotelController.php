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
            // Log the entire request
            Log::info('SalesFolderHotel store method called', ['request' => $request->all()]);

            // Define attributes and their types
            $attributes = [
                'SF_NO' => ['value' => $request->input('troNumber'), 'type' => 'string'],
                'DOC_ID' => ['value' => $request->input('docId'), 'type' => 'string'],
                'HOTEL_CODE' => ['value' => $request->input('hotelCode'), 'type' => 'string'],
                'CHECKIN_DATE' => ['value' => $request->input('checkInDate'), 'type' => 'string'],
                'CHECKIN_TIME' => ['value' => null, 'type' => 'NULL'],
                'CHECKOUT_DATE' => ['value' => $request->input('checkOutDate'), 'type' => 'string'],
                'CHECKOUT_TIME' => ['value' => null, 'type' => 'NULL'],
                'HOTEL_LOC' => ['value' => null, 'type' => 'NULL'],
                'CITY_CODE' => ['value' => null, 'type' => 'NULL'],
                'ROOM_TYPE' => ['value' => $request->input('roomType'), 'type' => 'string'],
                'ROOM_CAT' => ['value' => $request->input('roomCategory'), 'type' => 'string'],
                'NIGHT_NO' => ['value' => (int) $request->input('hotelNights'), 'type' => 'integer'],
                'STATUS' => ['value' => $request->input('bookStatus'), 'type' => 'string'],
                'GUEST_QTY' => ['value' => (int) $request->input('numberOfGuest'), 'type' => 'integer'],
                'ROOM_QTY' => ['value' => (int) $request->input('roomQuantity'), 'type' => 'integer'],
                'VIP_FLAG' => ['value' => $request->has('isVip') ? 1 : 0, 'type' => 'integer'],
                'MEAL_CODE_1' => ['value' => $request->input('hotelBreakfast'), 'type' => 'string'],
                'MEAL_CODE_2' => ['value' => $request->input('hotelLunch'), 'type' => 'string'],
                'MEAL_CODE_3' => ['value' => $request->input('hotelDinner'), 'type' => 'string'],
                'OTHER_SERVICE' => ['value' => $request->input('otherServices'), 'type' => 'string'],
                'REMARKS' => ['value' => $request->input('hotelRemarks'), 'type' => 'string'],
                'ORIGIN' => ['value' => 'M', 'type' => 'string'],
                'UPDATE_SOURCE' => ['value' => 'M', 'type' => 'string'],
            ];

            // Assign attributes to the SalesFolderHotel object
            $hotel = new SalesFolderHotel();
            foreach ($attributes as $key => $attribute) {
                if ($attribute['type'] === 'string') {
                    $hotel->$key = (string)$attribute['value'];
                } elseif ($attribute['type'] === 'integer') {
                    $hotel->$key = (int)$attribute['value'];
                } elseif ($attribute['type'] === 'decimal') {
                    $hotel->$key = (float)$attribute['value'];
                } elseif ($attribute['type'] === 'NULL') {
                    $hotel->$key = null;
                }
            }

            // Save the SalesFolderHotel object to the database
            $hotel->save();

            Log::info("Saved: " . $hotel);

            return response()->json([
                'success' => 'Hotel product created successfully',
                'data' => $hotel
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error in SalesFolderHotel store method', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => 'An error occurred while creating the hotel booking'
            ], 500);
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
