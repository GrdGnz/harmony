<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempSalesFolderAir;
use Log;

class TempSalesFolderAirController extends Controller
{
    public function deleteMultiple(Request $request)
    {
        $selectedRows = $request->input('selectedRows');

        try {
            if (!is_array($selectedRows) || empty($selectedRows)) {
                throw new \Exception('No rows selected for deletion.');
            }

            foreach ($selectedRows as $index) {
                $tempSalesFolderAir = TempSalesFolderAir::find($index);
                if ($tempSalesFolderAir) {
                    $tempSalesFolderAir->delete();
                    Log::info('TempSalesFolderAir record deleted successfully', [
                        'user_id' => auth()->id(),
                        'index' => $index,
                        'sf_no' => $tempSalesFolderAir->SF_NO,
                        'doc_id' => $tempSalesFolderAir->DOC_ID,
                    ]);
                } else {
                    Log::warning('TempSalesFolderAir record not found', [
                        'user_id' => auth()->id(),
                        'index' => $index,
                    ]);
                }
            }

            return response()->json(['message' => 'Selected rows deleted successfully.']);

        } catch (\Exception $e) {
            Log::error('Error deleting TempSalesFolderAir records: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'selected_rows' => $selectedRows,
            ]);

            return response()->json(['message' => 'Failed to delete selected rows. Please try again.'], 500);
        }
    }
}
