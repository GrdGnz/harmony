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
            Log::info('Received troNumber:', ['troNumber' => $troNumber]);

            $sfGroup = SalesFolderGroup::where('sf_no', $troNumber)
                ->orderBy('DOC_ID', 'desc')
                ->first();

            if (!$sfGroup) {
                // Get Next Doc ID
                $docId = 1;
            } else {
                // Get Next Doc ID
                $docId = $sfGroup->DOC_ID + 1;
            }

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
                'STATUS' => $request->input('bookStatus'),
                'GUEST_QTY' => $request->input('numberOfGuest'),
                'ROOM_QTY' => $request->input('roomQuantity'),
                'VIP_FLAG' => $request->has('isVip') ? 1 : 0,
                'MEAL_CODE_1' => $request->input('hotelBreakfast'),
                'MEAL_CODE_2' => $request->input('hotelLunch'),
                'MEAL_CODE_3' => $request->input('hotelDinner'),
                'OTHER_SERVICE' => $request->input('otherServices'),
                'REMARKS' => $request->input('hotelRemarks'),
            ]);

            return response()->json([
                'success' => 'Hotel booking created successfully!',
                'data' => $request->all(),
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating SalesFolderHotel:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'An error occurred while creating the hotel booking'], 500);
        }
    }

}
