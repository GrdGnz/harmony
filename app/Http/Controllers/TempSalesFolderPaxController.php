<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TempSalesFolderPax;
use Log;

class TempSalesFolderPaxController extends Controller
{
    public function saveTickets(Request $request)
    {
        try {
            $this->truncateTemporaryPaxTable();

            $troNumber = $request->input('troNumber');
            $docId = $request->input('docId');
            $tickets = $request->input('tickets');

            Log::info($tickets);

            foreach ($tickets as $ticket) {
                TempSalesFolderPax::create([
                    'SF_NO' => $troNumber,
                    'DOC_ID' => $docId,  // Adjust this if needed
                    'PAX_NAME' => $ticket['paxName'],
                    'TICKET_NO' => $ticket['ticketNo'],
                    'PNR' => $ticket['pnr']
                ]);
            }

            return response()->json(['redirect_url' => route('forms.tro.add_product', ['troNumber' => $troNumber])]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving tickets: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Error saving tickets. Please try again.'], 500);
        }
    }

    public function truncateTemporaryPaxTable()
    {
        try {
            DB::table('TEMP_SALES_FOLDER_PAX')->truncate();
            Log::info('TEMP_SALES_FOLDER_PAX table truncated.');
            return response()->json(['message' => 'TEMP_SALES_FOLDER_PAX table truncated.'], 200);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_PAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error truncating TEMP_SALES_FOLDER_PAX table.'], 500);
        }
    }
}
