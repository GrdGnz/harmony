<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TempSalesFolderPax;
use App\Models\TempSalesFolderTax;
use Log;

class TempSalesFolderPaxController extends Controller
{
    public function saveTickets(Request $request)
    {
        try {
            //$this->truncateTemporaryPaxTable($request);

            $troNumber = $request->input('troNumber');
            $docId = $request->input('docId');
            $tickets = $request->input('passengerTicketNumber');

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

    public function savePax(Request $request)
    {
        try {
            $troNumber = $request->input('troNumber');
            $docId = $request->input('docId');
            $ticket = $request->input('passengerTicketNumber');
            $passengerName = $request->input('passengerName');
            $pnr = $request->input('passengerPNR');

            // Check if a ticket with the same number already exists for this TRO
            $existingPax = TempSalesFolderPax::where('SF_NO', $troNumber)
                ->where('TICKET_NO', $ticket)
                ->first();

            if ($existingPax) {
                // Duplicate ticket found, return an error response
                return response()->json(['error' => 'Duplicate ticket number found.'], 400);
            }

            // If no duplicate found, proceed with saving the passenger
            $newPax = TempSalesFolderPax::create([
                'SF_NO' => $troNumber,
                'DOC_ID' => $docId,  // Adjust this if needed
                'PAX_NAME' => $passengerName,
                'TICKET_NO' => $ticket,
                'PNR' => $pnr
            ]);

            $allPax = TempSalesFolderPax::where('SF_NO', $troNumber)->get();

            Log::info($allPax); // Log data to debug

            // Return the newly created record as part of the response
            return response()->json([
                'message' => 'Passenger saved successfully',
                'data' => $allPax
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving tickets: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Error saving tickets. Please try again.'], 500);
        }
    }


    public function truncateTemporaryPaxTable(Request $request)
    {
        try {
            $troNumber = $request->input('troNumber');

            DB::table('TEMP_SALES_FOLDER_PAX')->truncate();
            Log::info('TEMP_SALES_FOLDER_PAX table truncated.');
            return response()->json([
                'message' => 'TEMP_SALES_FOLDER_PAX table truncated.',
                'redirect_url' => route('forms.tro.add_product', ['troNumber' => $troNumber]),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_PAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error truncating TEMP_SALES_FOLDER_PAX table.'], 500);
        }
    }

    public function deletePax(Request $request)
    {
        try {
            $ticketNumber = $request->input('ticketNumber');

            Log::info('Delete ticket number: '.$ticketNumber);

            $row = TempSalesFolderPax::where('TICKET_NO', $ticketNumber)->first();

            if ($row) {
                $row->delete();
                Log::info('Data successfully deleted.');

                // Fetch all passengers for the given troNumber
                $troNumber = $row->SF_NO;
                $allPax = TempSalesFolderPax::where('SF_NO', $troNumber)->get();

                return response()->json([
                    'message' => 'Passenger record deleted successfully.',
                    'data' => $allPax
                ]);
            } else {
                return response()->json(['error' => 'Passenger record not found.'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting passenger record: ' . $e->getMessage());
            return response()->json(['error' => 'Error deleting passenger record. Please try again.'], 500);
        }
    }

    public function countTotalPax(Request $request)
    {
        try {

            $troNumber = $request->input('troNumber');

            $count = TempSalesFolderPax::count();

            Log::info('Pax count: '.$count);

            if($count) {
                return response()->json([
                    'count' => $count,
                    'message' => 'Successfully returned pax count.'
                ]);
            } else {
                Log::error('Error getting count');
                return response()->json([
                    'count' => 0,
                    'message' => 'Cannot get count'
                ]);
            }

        } catch(\Exception $e) {
            Log::error('Error getting count: '. $e->getMessage());
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

}
