<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesFolderGroup;
use App\Models\SalesFolderAir;
use App\Models\SalesFolderPax;
use App\Models\SalesFolderTax;
use App\Models\SalesFolderHotel;
use App\Models\SalesFolderTransfer;
use App\Models\SalesFolderMisc;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SalesFolderGroupController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log the entire request
            Log::info('SalesFolderGroup store method called', ['request' => $request->all()]);

            $salesFolderGroup = new SalesFolderGroup();

            // Define attributes and their types
            $attributes = [
                'SF_NO' => ['value' => $request->input('troNumber'), 'type' => 'string'],
                'DOC_ID' => ['value' => (int) $this->unformatNumber($request->input('docId')), 'type' => 'integer'],
                'PROD_TYPE' => ['value' => $request->input('productType'), 'type' => 'string'],
                'PROD_CAT' => ['value' => $request->input('productCategory'), 'type' => 'string'],
                'PNR' => ['value' => null, 'type' => 'NULL'],
                'AL_PNR' => ['value' => $request->input('productType') == 'Air' ? $request->input('airline') : null, 'type' => 'string'],
                'ROUTE' => ['value' => $request->input('route'), 'type' => 'string'],
                'QTY' => ['value' => (int) $this->unformatNumber($request->input('costUnitQuantity')), 'type' => 'integer'],
                'TAX_TYPE' => ['value' => 'N', 'type' => 'string'],
                'TAX_AMT' => ['value' => (float) $this->unformatNumber($request->input('costTax')), 'type' => 'decimal'],
                'TAX_RATE' => ['value' => 0, 'type' => 'integer'],
                'CHARGE_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SELL_CURR_CODE' => ['value' => $request->input('salesCurrencyCode'), 'type' => 'string'],
                'SELL_CURR_RATE' => ['value' => (float) $this->unformatNumber($request->input('salesCurrencyAmount')), 'type' => 'decimal'],
                'SELL_AMT' => ['value' => (float) $this->unformatNumber($request->input('salesUnitAmount')), 'type' => 'decimal'],
                'SELL_TTAX_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SELL_DISC_AMT' => ['value' => (float) $this->unformatNumber($request->input('salesDiscountAmount')), 'type' => 'decimal'],
                'SELL_DISC_PERC' => ['value' => (float) $this->unformatNumber($request->input('salesDiscountRate')), 'type' => 'decimal'],
                'SELL_COMM_AMT' => ['value' => (float) $this->unformatNumber($request->input('salesCommissionAmount')), 'type' => 'decimal'],
                'SELL_COMM_PERC' => ['value' => (float) $this->unformatNumber($request->input('salesCommissionRate')), 'type' => 'decimal'],
                'SELL_INS_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SELL_SURCHARGE' => ['value' => (float) $this->unformatNumber($request->input('salesSurcharge')), 'type' => 'decimal'],
                'TTL_SELL_AMT' => ['value' => (float) $this->unformatNumber($request->input('salesTotalUnitAmount')), 'type' => 'decimal'],
                'SELL_GRAND_TOTAL' => ['value' => (float) $this->unformatNumber($request->input('salesGrandTotal')), 'type' => 'decimal'],
                'PUBLISH_AMT' => ['value' => (float) $this->unformatNumber($request->input('costUnitAmount')), 'type' => 'decimal'],
                'SPL_FARE_CODE' => ['value' => 0, 'type' => 'integer'],
                'NETT_AMT' => ['value' => 0, 'type' => 'decimal'],
                'NET_FARE_FLAG' => ['value' => 'N', 'type' => 'string'],
                'NAIR_NETT_AMT' => ['value' => (float) $this->unformatNumber($request->input('nonAirNetRate')), 'type' => 'decimal'],
                'COST_COMM_AMT' => ['value' => (float) $this->unformatNumber($request->input('costCommissionAmount')), 'type' => 'decimal'],
                'COST_COMM_PERC' => ['value' => (float) $this->unformatNumber($request->input('costCommissionRate')), 'type' => 'decimal'],
                'COST_DISC_AMT' => ['value' => (float) $this->unformatNumber($request->input('costDiscountAmount')), 'type' => 'decimal'],
                'COST_DISC_PERC' => ['value' => (float) $this->unformatNumber($request->input('costDiscountRate')), 'type' => 'decimal'],
                'COST_TTAX_AMT' => ['value' => (float) $this->unformatNumber($request->input('costTax')), 'type' => 'decimal'],
                'COST_INS_AMT' => ['value' => (float) $this->unformatNumber($request->input('costInsurance')), 'type' => 'decimal'],
                'COST_CURR_CODE' => ['value' => $request->input('costCurrencyCode'), 'type' => 'string'],
                'COST_CURR_RATE' => ['value' => (float) $this->unformatNumber($request->input('costCurrencyAmount')), 'type' => 'decimal'],
                'TTL_COST_AMT' => ['value' => (float) $this->unformatNumber($request->input('costTotalUnitCost')), 'type' => 'decimal'],
                'COST_GRAND_TOTAL' => ['value' => (float) $this->unformatNumber($request->input('costGrandTotal')), 'type' => 'decimal'],
                'INCOME' => ['value' => 0, 'type' => 'decimal'],
                'SELL_AMT_1' => ['value' => 0, 'type' => 'decimal'],
                'SELL_AMT_2' => ['value' => 0, 'type' => 'decimal'],
                'SELL_AMT_3' => ['value' => 0, 'type' => 'decimal'],
                'SELL_AMT_4' => ['value' => 0, 'type' => 'decimal'],
                'SELL_AMT_5' => ['value' => 0, 'type' => 'decimal'],
                'CURR_CODE_1' => ['value' => 'PHP', 'type' => 'string'],
                'CURR_CODE_2' => ['value' => 'PHP', 'type' => 'string'],
                'CURR_CODE_3' => ['value' => 'PHP', 'type' => 'string'],
                'CURR_CODE_4' => ['value' => 'PHP', 'type' => 'string'],
                'CURR_CODE_5' => ['value' => 'PHP', 'type' => 'string'],
                'CURR_RATE_1' => ['value' => 1.00, 'type' => 'decimal'],
                'CURR_RATE_2' => ['value' => 1.00, 'type' => 'decimal'],
                'CURR_RATE_3' => ['value' => 1.00, 'type' => 'decimal'],
                'CURR_RATE_4' => ['value' => 1.00, 'type' => 'decimal'],
                'CURR_RATE_5' => ['value' => 1.00, 'type' => 'decimal'],
                'SUPP_ID' => ['value' => null, 'type' => 'NULL'],
                'ACCT_CODE' => ['value' => null, 'type' => 'NULL'],
                'XO_NO' => ['value' => null, 'type' => 'NULL'],
                'VOUCHER_NO' => ['value' => null, 'type' => 'NULL'],
                'MPD_TICKET_NO' => ['value' => null, 'type' => 'NULL'],
                'TOUR_CODE' => ['value' => null, 'type' => 'NULL'],
                'BULK_FLAG' => ['value' => 'N', 'type' => 'string'],
                'ETICKET_FLAG' => ['value' => 'N', 'type' => 'string'],
                'GDS_PROVIDER' => ['value' => null, 'type' => 'NULL'],
                'SHORT_DESCR' => ['value' => null, 'type' => 'NULL'],
                'LONG_DESCR' => ['value' => $request->input('longItineraryDesc'), 'type' => 'string'],
                'REMARKS' => ['value' => $request->input('generalRemarks'), 'type' => 'string'],
                'AIRLINE_REMARKS' => ['value' => $request->input('airlineReference'), 'type' => 'string'],
                'PRINT_LONG_DESCR' => ['value' => 'N', 'type' => 'string'],
                'CASH_INV_CNT' => ['value' => 0, 'type' => 'integer'],
                'CREDIT_INV_CNT' => ['value' => 1, 'type' => 'integer'],
                'CHARGE_INV_CNT' => ['value' => 0, 'type' => 'integer'],
                'UATP_INV_CNT' => ['value' => 0, 'type' => 'integer'],
                'MIX_INV_CNT' => ['value' => 0, 'type' => 'integer'],
                'CAV_CNT' => ['value' => 0, 'type' => 'integer'],
                'BYPASS_FLAG' => ['value' => 'N', 'type' => 'string'],
                'SUPRESS_PRINT' => ['value' => $request->input('sfGroupSupressPrint') == 'Y' ? 'Y' : 'N', 'type' => 'string'],
                'GROUP_FLAG' => ['value' => $request->input('sfGroupFlag') == 'Y' ? 'Y' : 'N', 'type' => 'string'],
                'GROUP_PRODUCT' => ['value' => $request->input('sfGroupProduct') == 'Y' ? 'Y' : 'N', 'type' => 'string'],
                'GROUP_ID' => ['value' => $request->input('sfGroupId'), 'type' => 'string'],
                'UPDATE_SOURCE' => ['value' => 'M', 'type' => 'string'],
                'PAX_DESCR' => ['value' => $request->input('paxDescription'), 'type' => 'string'],
                'FARE_CALC' => ['value' => $request->input('fareCalculation'), 'type' => 'string'],
            ];

            // Assign attributes to the salesFolderGroup object
            foreach ($attributes as $key => $attribute) {
                if ($attribute['type'] === 'string') {
                    $salesFolderGroup->$key = (string)$attribute['value'];
                } elseif ($attribute['type'] === 'integer') {
                    $salesFolderGroup->$key = (int)$attribute['value'];
                } elseif ($attribute['type'] === 'decimal') {
                    $salesFolderGroup->$key = (float)$attribute['value'];
                } elseif ($attribute['type'] === 'NULL') {
                    $salesFolderGroup->$key = null;
                }
            }

            // Save the salesFolderGroup object to the database
            $salesFolderGroup->save();

            Log::info("Saved: ". $salesFolderGroup);

            return response()->json([
                'message' => 'Sales folder group created successfully'
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error in SalesFolderGroup store method', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'An error occurred while creating the sales folder group'
            ], 500);
        }
    }


    public function delete($troNumber, $docId)
    {
        DB::beginTransaction();

        try {
            // Delete the record from SalesFolderGroup using SF_NO and DOC_ID
            $affected = SalesFolderGroup::where('SF_NO', $troNumber)
                                        ->where('DOC_ID', $docId)
                                        ->delete();

            if ($affected > 0) {
                Log::info("Record deleted from SalesFolderGroup.", ['troNumber' => $troNumber, 'docId' => $docId]);
            } else {
                Log::warning("Record not found in SalesFolderGroup.", ['troNumber' => $troNumber, 'docId' => $docId]);
                throw new \Exception('Record not found in SalesFolderGroup.');
            }

            // Fetch TICKET_NO from SalesFolderPax records to be deleted
            $ticketNumbers = SalesFolderPax::where('SF_NO', $troNumber)
                ->where('DOC_ID', $docId)
                ->pluck('TICKET_NO');

            // Update Inventory records where TICKET_NO matches and set SF_NO to NULL using a raw query
            if ($ticketNumbers->isNotEmpty()) {
                $ticketNumbersArray = $ticketNumbers->toArray();
                DB::table('INVENTORY')->whereIn('TICKET_NO', $ticketNumbersArray)->update(['SF_NO' => null]);
                DB::table('SALES_FOLDER_PAX')->whereIn('TICKET_NO', $ticketNumbersArray)->update(['TICKET_NO' => null]);
                Log::info("Inventory records updated to set SF_NO to NULL.", ['troNumber' => $troNumber, 'ticketNumbers' => $ticketNumbers]);
            }

            // Delete related records in other models
            SalesFolderAir::where('SF_NO', $troNumber)->where('DOC_ID', $docId)->delete();
            SalesFolderPax::where('SF_NO', $troNumber)->where('DOC_ID', $docId)->delete();
            SalesFolderTax::where('SF_NO', $troNumber)->where('DOC_ID', $docId)->delete();
            SalesFolderHotel::where('SF_NO', $troNumber)->where('DOC_ID', $docId)->delete();
            SalesFolderTransfer::where('SF_NO', $troNumber)->where('DOC_ID', $docId)->delete();
            SalesFolderMisc::where('SF_NO', $troNumber)->where('DOC_ID', $docId)->delete();

            Log::info("Related records deleted from SalesFolderAir, SalesFolderPax, SalesFolderHotel, and SalesFolderTransfer.", ['troNumber' => $troNumber, 'docId' => $docId]);

            DB::commit();

            // Redirect with success message
            return redirect()->back()->with('success', 'Record and related data deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log the exception
            Log::error("Error deleting record and related data.", [
                'troNumber' => $troNumber,
                'docId' => $docId,
                'error' => $e->getMessage()
            ]);

            // Redirect with error message if there is an exception
            return redirect()->back()->with('error', 'An error occurred while deleting the record.');
        }
    }

    public function bulkDelete(Request $request)
    {
        $selectedProducts = $request->input('selectedProducts');
        if (empty($selectedProducts)) {
            return redirect()->back()->with('error', 'No products selected for deletion.');
        }

        DB::beginTransaction();

        try {
            foreach ($selectedProducts as $product) {
                list($troNumber, $docId) = explode('_', $product);
                $this->delete($troNumber, $docId);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Selected products deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error in bulk deleting records.", [
                'selectedProducts' => $selectedProducts,
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'An error occurred while deleting the selected products.');
        }
    }

    //Unformat a number
    function unformatNumber($number) {
        return str_replace(',', '', $number);
    }

    public function update(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'troNumber' => 'required|string',
                'docId' => 'required|integer',
                // Add more validation rules for other fields as needed
            ]);

            // Prepare the attributes based on the provided $attributes array
            $attributes = [
                'SF_NO' => $request->input('troNumber'),
                'DOC_ID' => $request->input('docId'),
                'PNR' => null,
                'AL_PNR' => $request->input('productType') == 'Air' ? $request->input('airline') : null,
           'QTY' => (int) $request->input('costUnitQuantity'),
                'TAX_TYPE' => 'N',
                'TAX_AMT' => (float) $this->unformatNumber($request->input('costTax')),
                'TAX_RATE' => 0,
                'CHARGE_AMT' => 0,
                'SELL_CURR_CODE' => $request->input('salesCurrencyCode'),
                'SELL_CURR_RATE' => (float) $request->input('salesCurrencyAmount'),
                'SELL_AMT' => (float) $this->unformatNumber($request->input('salesUnitAmount')),
                'SELL_TTAX_AMT' => 0,
                'SELL_DISC_AMT' => (float) $this->unformatNumber($request->input('salesDiscountAmount')),
                'SELL_DISC_PERC' => (float) $request->input('salesDiscountRate'),
                'SELL_COMM_AMT' => (float) $this->unformatNumber($request->input('salesCommissionAmount')),
                'SELL_COMM_PERC' => (float) $request->input('salesCommissionRate'),
                'SELL_INS_AMT' => 0,
                'SELL_SURCHARGE' => (float) $request->input('salesSurcharge'),
                'TTL_SELL_AMT' => (float) $this->unformatNumber($request->input('salesTotalUnitAmount')),
                'SELL_GRAND_TOTAL' => (float) $this->unformatNumber($request->input('salesGrandTotal')),
                'PUBLISH_AMT' => (float) $this->unformatNumber($request->input('costUnitAmount')),
                'SPL_FARE_CODE' => 0,
                'NETT_AMT' => 0,
                'NET_FARE_FLAG' => 'N',
                'NAIR_NETT_AMT' => (float) $this->unformatNumber($request->input('nonAirNetRate')),
                'COST_COMM_AMT' => (float) $this->unformatNumber($request->input('costCommissionAmount')),
                'COST_COMM_PERC' => (float) $request->input('costCommissionRate'),
                'COST_DISC_AMT' => (float) $this->unformatNumber($request->input('costDiscountAmount')),
                'COST_DISC_PERC' => (float) $request->input('costDiscountRate'),
                'COST_TTAX_AMT' => (float) $this->unformatNumber($request->input('costTax')),
                'COST_INS_AMT' => (float) $this->unformatNumber($request->input('costInsurance')),
                'COST_CURR_CODE' => $request->input('costCurrencyCode'),
                'COST_CURR_RATE' => (float) $request->input('costCurrencyAmount'),
                'TTL_COST_AMT' => (float) $this->unformatNumber($request->input('costTotalUnitCost')),
                'COST_GRAND_TOTAL' => (float) $this->unformatNumber($request->input('costGrandTotal')),
                'INCOME' => 0,
                'SELL_AMT_1' => 0,
                'SELL_AMT_2' => 0,
                'SELL_AMT_3' => 0,
                'SELL_AMT_4' => 0,
                'SELL_AMT_5' => 0,
                'CURR_CODE_1' => 'PHP',
                'CURR_CODE_2' => 'PHP',
                'CURR_CODE_3' => 'PHP',
                'CURR_CODE_4' => 'PHP',
                'CURR_CODE_5' => 'PHP',
                'CURR_RATE_1' => 1.00,
                'CURR_RATE_2' => 1.00,
                'CURR_RATE_3' => 1.00,
                'CURR_RATE_4' => 1.00,
                'CURR_RATE_5' => 1.00,
                'SUPP_ID' => null,
                'ACCT_CODE' => null,
                'XO_NO' => null,
                'VOUCHER_NO' => null,
                'MPD_TICKET_NO' => null,
                'TOUR_CODE' => null,
                'BULK_FLAG' => 'N',
                'ETICKET_FLAG' => 'N',
                'GDS_PROVIDER' => null,
                'SHORT_DESCR' => null,
                'LONG_DESCR' => $request->input('longItineraryDesc'),
                'REMARKS' => $request->input('generalRemarks'),
                'AIRLINE_REMARKS' => $request->input('airlineReference'),
                'FARE_CALC' => $request->input('fareCalculation'),
                'PAX_DESCR' => $request->input('paxDescription'),
                'PRINT_LONG_DESCR' => 'N',
                'CASH_INV_CNT' => 0,
                'CREDIT_INV_CNT' => 1,
                'CHARGE_INV_CNT' => 0,
                'UATP_INV_CNT' => 0,
                'MIX_INV_CNT' => 0,
                'CAV_CNT' => 0,
                'BYPASS_FLAG' => 'N',
                'SUPRESS_PRINT' => $request->input('sfGroupSupressPrint') == 'Y' ? 'Y' : 'N',
                'GROUP_FLAG' => $request->input('sfGroupFlag') == 'Y' ? 'Y' : 'N',
                'GROUP_PRODUCT' => $request->input('sfGroupProduct') == 'Y' ? 'Y' : 'N',
                'GROUP_ID' => $request->input('sfGroupId'),
                'UPDATE_SOURCE' => 'M',
            ];

            Log::info('Attributes array:', $attributes);

            // Use DB transaction for atomic operation
            DB::beginTransaction();

            // Update the SalesFolderGroup record
            DB::table('SALES_FOLDER_GROUP')
                ->where('SF_NO', $attributes['SF_NO'])
                ->where('DOC_ID', $attributes['DOC_ID'])
                ->update($attributes);

            // Add product category in response
            $group = DB::table('SALES_FOLDER_GROUP')
                            ->where('SF_NO', $attributes['SF_NO'])
                            ->where('DOC_ID', $attributes['DOC_ID'])
                            ->first();

            // Commit transaction if all queries succeed
            DB::commit();

            // Return a JSON response indicating success
            return response()->json([
                'message' => 'Sales Folder Group updated successfully.',
                'category' => $group->PROD_CAT,
            ]);
        } catch (\Exception $e) {
            // Rollback transaction if any errors occur
            DB::rollback();

            // Log the error
            Log::error('Error updating Sales Folder Group: ' . $e->getMessage());

            // Return a JSON response with error message
            return response()->json(['error' => 'Failed to update Sales Folder Group.'], 500);
        }
    }

}
