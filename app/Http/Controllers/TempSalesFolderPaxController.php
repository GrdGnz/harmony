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
            $this->truncateTemporaryTaxTable($request);

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

            return response()->json([
                'redirect_url' => route('forms.tro.add_product', ['troNumber' => $troNumber])
            ]);
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

            $totalCount = $allPax->count();

            Log::info($allPax); // Log data to debug

            // Return the newly created record as part of the response
            return response()->json([
                'message' => 'Passenger saved successfully',
                'data' => $allPax,
                'totalCount' => $totalCount,
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving tickets: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Error saving tickets. Please try again.'], 500);
        }
    }

    public function deletePax(Request $request)
    {
        try {
            $ticketNumbers = $request->input('ticketNumbers', []);

            if (!empty($ticketNumbers)) {
                // Fetch the corresponding troNumber from one of the tickets
                $troNumber = TempSalesFolderPax::whereIn('TICKET_NO', $ticketNumbers)->value('SF_NO');

                // Delete passengers with the given ticket numbers
                TempSalesFolderPax::whereIn('TICKET_NO', $ticketNumbers)->delete();

                // Fetch all remaining passengers for the given troNumber
                $allPax = TempSalesFolderPax::where('SF_NO', $troNumber)->get();

                Log::info('Deleted ticket numbers: ' . implode(', ', $ticketNumbers));
                Log::info($allPax); // Log data to debug

                return response()->json([
                    'message' => 'Selected passengers deleted successfully.',
                    'data' => $allPax
                ]);
            }

            return response()->json(['error' => 'No passengers selected for deletion.'], 400);
        } catch (\Exception $e) {
            Log::error('Error deleting passenger records: ' . $e->getMessage());
            return response()->json(['error' => 'Error deleting passenger records. Please try again.'], 500);
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

    public function truncateTemporaryTaxTable(Request $request)
    {
        try {
            $troNumber = $request->input('troNumber');

            DB::table('TEMP_SALES_FOLDER_TAX')->truncate();
            Log::info('TEMP_SALES_FOLDER_TAX table truncated.');
            return response()->json([
                'message' => 'TEMP_SALES_FOLDER_TAX table truncated.',
                'redirect_url' => route('forms.tro.add_product', ['troNumber' => $troNumber]),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error truncating TEMP_SALES_FOLDER_TAX table: ' . $e->getMessage());
            return response()->json(['message' => 'Error truncating TEMP_SALES_FOLDER_TAX table.'], 500);
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
