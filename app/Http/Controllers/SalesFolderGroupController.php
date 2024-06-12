<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesFolder;
use App\Models\SalesFolderGroup;
use Log;

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
                'DOC_ID' => ['value' => (int) $request->input('docId'), 'type' => 'integer'],
                'PROD_TYPE' => ['value' => $request->input('productType'), 'type' => 'string'],
                'PROD_CAT' => ['value' => $request->input('productCategory'), 'type' => 'string'],
                'PNR' => ['value' => null, 'type' => 'NULL'],
                'AL_PNR' => ['value' => $request->input('productType') == 'Air' ? $request->input('airline') : null, 'type' => 'string'],
                'ROUTE' => ['value' => $request->input('route'), 'type' => 'string'],
                'QTY' => ['value' => (int) $request->input('salesUnitQuantity'), 'type' => 'integer'],
                'TAX_TYPE' => ['value' => 'N', 'type' => 'string'],
                'TAX_AMT' => ['value' => (float) $request->input('salesTax'), 'type' => 'decimal'],
                'TAX_RATE' => ['value' => 0, 'type' => 'integer'],
                'CHARGE_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SELL_CURR_CODE' => ['value' => $request->input('salesCurrencyCode'), 'type' => 'string'],
                'SELL_CURR_RATE' => ['value' => (float) $request->input('salesCurrencyAmount'), 'type' => 'decimal'],
                'SELL_AMT' => ['value' => (float) $request->input('salesUnitAmount'), 'type' => 'decimal'],
                'SELL_TTAX_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SELL_DISC_AMT' => ['value' => (float) $request->input('salesDiscountAmount'), 'type' => 'decimal'],
                'SELL_DISC_PERC' => ['value' => (float) $request->input('salesDiscountRate'), 'type' => 'decimal'],
                'SELL_COMM_AMT' => ['value' => (float) $request->input('salesCommissionAmount'), 'type' => 'decimal'],
                'SELL_COMM_PERC' => ['value' => (float) $request->input('salesCommissionRate'), 'type' => 'decimal'],
                'SELL_INS_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SELL_SURCHARGE' => ['value' => (float) $request->input('salesSurcharge'), 'type' => 'decimal'],
                'TTL_SELL_AMT' => ['value' => (float) $request->input('salesTotalUnitAmount'), 'type' => 'decimal'],
                'SELL_GRAND_TOTAL' => ['value' => (float) $request->input('salesGrandTotal'), 'type' => 'decimal'],
                'PUBLISH_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SPL_FARE_CODE' => ['value' => 0, 'type' => 'integer'],
                'NETT_AMT' => ['value' => 0, 'type' => 'decimal'],
                'NET_FARE_FLAG' => ['value' => 'N', 'type' => 'string'],
                'NAIR_NETT_AMT' => ['value' => 0, 'type' => 'decimal'],
                'COST_COMM_AMT' => ['value' => (float) $request->input('costCommissionAmount'), 'type' => 'decimal'],
                'COST_COMM_PERC' => ['value' => (float) $request->input('costCommissionRate'), 'type' => 'decimal'],
                'COST_DISC_AMT' => ['value' => (float) $request->input('costDiscountAmount'), 'type' => 'decimal'],
                'COST_DISC_PERC' => ['value' => (float) $request->input('costDiscountRate'), 'type' => 'decimal'],
                'COST_TTAX_AMT' => ['value' => (float) $request->input('costTax'), 'type' => 'decimal'],
                'COST_INS_AMT' => ['value' => 0, 'type' => 'decimal'],
                'COST_CURR_CODE' => ['value' => $request->input('costCurrencyCode'), 'type' => 'string'],
                'COST_CURR_RATE' => ['value' => (float) $request->input('costCurrencyAmount'), 'type' => 'decimal'],
                'TTL_COST_AMT' => ['value' => (float) $request->input('costTotalUnitCost'), 'type' => 'decimal'],
                'COST_GRAND_TOTAL' => ['value' => (float) $request->input('costGrandTotal'), 'type' => 'decimal'],
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
                'SUPRESS_PRINT' => ['value' => 'N', 'type' => 'string'],
                'PAX_DESCR' => ['value' => null, 'type' => 'NULL'],
                'PRINT_PAX_DESCR' => ['value' => 'N', 'type' => 'string'],
                'FIRST_PAX_NAME' => ['value' => null, 'type' => 'NULL'],
                'SECOND_PAX_NAME' => ['value' => null, 'type' => 'NULL'],
                'PKG_FLAG' => ['value' => 'N', 'type' => 'string'],
                'GROUP_FLAG' => ['value' => 'N', 'type' => 'string'],
                'XO_AMT' => ['value' => 0, 'type' => 'decimal'],
                'INV_AMT' => ['value' => 0, 'type' => 'decimal'],
                'CAV_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SELL_BAL_AMT' => ['value' => 0, 'type' => 'decimal'],
                'COST_BAL_AMT' => ['value' => 0, 'type' => 'decimal'],
                'SHOW_CONV' => ['value' => 'N', 'type' => 'string'],
                'FARE_SAVE_AMT' => ['value' => 0, 'type' => 'decimal'],
                'STAFF_DISC_PERC' => ['value' => (float) 0, 'type' => 'decimal'],
                'STAFF_DISC_AMT' => ['value' => (float) 0, 'type' => 'decimal'],
                'PROMO_ALLOC' => ['value' => (float) 0, 'type' => 'decimal'],
                'ADM_ALLOC' => ['value' => (float) 0, 'type' => 'decimal'],
                'LOWEST_FARE' => ['value' => (float) 0, 'type' => 'decimal'],
                'IATA_FARE' => ['value' => (float) 0, 'type' => 'decimal'],
            ];

            foreach ($attributes as $attribute => $data) {
                Log::info('Setting SalesFolderGroup attribute', [
                    'attribute' => $attribute,
                    'value' => $data['value'],
                    'type' => $data['type']
                ]);
                $salesFolderGroup->$attribute = $data['value'];
            }

            $salesFolderGroup->save();

            Log::info('SalesFolderGroup saved successfully', ['salesFolderGroup' => $salesFolderGroup]);

            return response()->json(['message' => 'Sales Folder Group saved successfully'], 201);
        } catch (\Exception $e) {
            Log::error('Failed to save SalesFolderGroup', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json(['message' => 'Failed to save Sales Folder Group', 'error' => $e->getMessage()], 500);
        }
    }

}
