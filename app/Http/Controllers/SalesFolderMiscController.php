<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesFolderMisc;
use Log;

class SalesFolderMiscController extends Controller
{
    public function store(Request $request)
    {
        try {
            $troNumber = $request->input('troNumber');
            $docId = $request->input('docId');

            SalesFolderMisc::create([
                'SF_NO' => $troNumber,
                'DOC_ID' => $docId,
                'MISC_CODE' => $request->input('miscType'),
                'DOC_FLAG' => 'Y',
                'PROC_CENTER' => $request->input('procCenter'),
                'DOC_OFFICER' => $request->input('docOfficer'),
                'START_DATE' => $request->input('miscStartDate'),
                'START_LOC' => $request->input('miscStartLoc'),
                'END_DATE' => $request->input('miscEndDate'),
                'END_LOC' => $request->input('miscEndLoc'),
                'SERVICE_CLASS' => $request->input('miscServiceClass'),
                'STATUS' => $request->input('miscStatus'),
                'REMARKS' => $request->input('miscRemarks'),
                'ORIGIN' => 'M',
                'UPDATE_SOURCE' => 'M',
            ]);

            return response()->json([
                'success' => 'Misc product created successfully!',
                'data' => $request->all(),
            ]);
        } catch(\Exception $e) {
            Log::error('Error creating SalesFolderMisc:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'An error occurred while creating the Misc Sales Folder'], 500);
        }
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'sfNo' => 'required|string|max:255',
            'docId' => 'required|string|max:255',
            'miscType' => 'required|string|max:255',
            'additionalDescription' => 'nullable|string|max:255',
            'miscServiceClass' => 'nullable|string|max:255',
            'miscStatus' => 'nullable|string|max:255',
            'miscStartDate' => 'required|date',
            'miscStartLoc' => 'nullable|string|max:255',
            'miscEndDate' => 'required|date',
            'miscEndLoc' => 'nullable|string|max:255',
            'miscRemarks' => 'nullable|string|max:255',
            'procCenter' => 'nullable|string|max:255',
            'docOfficer' => 'nullable|string|max:255',
            'miscCategory' => 'nullable|string|max:255',
            'miscConfNo' => 'nullable|string|max:255',
            'miscPaxRefNo' => 'nullable|string|max:255',
        ]);

        try {
            // Find the SalesFolderMisc record by SF_NO and DOC_ID
            $sfMisc = SalesFolderMisc::where('SF_NO', $validatedData['sfNo'])
                                     ->where('DOC_ID', $validatedData['docId'])
                                     ->firstOrFail();

            // Update the record with the validated data
            $sfMisc->update([
                'MISC_CODE' => $validatedData['miscType'],
                'ADDITIONAL_SERVICE' => $validatedData['additionalDescription'],
                'SERVICE_CLASS' => $validatedData['miscServiceClass'],
                'STATUS' => $validatedData['miscStatus'],
                'START_DATE' => $validatedData['miscStartDate'],
                'START_LOC' => $validatedData['miscStartLoc'],
                'END_DATE' => $validatedData['miscEndDate'],
                'END_LOC' => $validatedData['miscEndLoc'],
                'REMARKS' => $validatedData['miscRemarks'],
                'PROC_CENTER' => $validatedData['procCenter'],
                'DOC_OFFICER' => $validatedData['docOfficer'],
                'MISC_CAT' => $validatedData['miscCategory'],
                'CONF_NO' => $validatedData['miscConfNo'],
                'PAX_REF_NO' => $validatedData['miscPaxRefNo'],
                'UPDATE_SOURCE' => 'M',
            ]);

            // Log the update
            Log::info('SalesFolderMisc record updated successfully', ['SF_NO' => $validatedData['sfNo'], 'DOC_ID' => $validatedData['docId'], 'data' => $validatedData]);

            return response()->json(['message' => 'Miscellaneous itinerary updated successfully.'], 200);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating SalesFolderMisc record', ['SF_NO' => $validatedData['sfNo'], 'DOC_ID' => $validatedData['docId'], 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update miscellaneous itinerary. Please try again.'], 500);
        }
    }
}
