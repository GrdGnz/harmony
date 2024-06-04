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
}
