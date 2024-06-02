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
            Log::info('SalesFolderGroup store method called', ['request' => $request->all()]);

            $salesFolderGroup = new SalesFolderGroup();
            $salesFolderGroup->SF_NO = $request->input('troNumber');
            $salesFolderGroup->DOC_ID = $request->input('docId');
            $salesFolderGroup->PROD_TYPE = $request->input('productType');
            $salesFolderGroup->PROD_CAT = $request->input('productCategory');
            $salesFolderGroup->PNR = null;
            $salesFolderGroup->AL_PNR = $request->input('productType') == 'Air' ? $request->input('airline') : null;
            $salesFolderGroup->ROUTE = $request->input('route');
            $salesFolderGroup->QTY = $request->input('salesUnitQuantity');
            $salesFolderGroup->TAX_TYPE = 'N';
            $salesFolderGroup->TAX_AMT = $request->input('salesTax');
            $salesFolderGroup->TAX_RATE = 0;
            $salesFolderGroup->CHARGE_AMT = 0;
            $salesFolderGroup->SELL_CURR_CODE = $request->input('salesCurrencyCode');
            $salesFolderGroup->SELL_CURR_RATE = $request->input('salesCurrencyAmount');
            $salesFolderGroup->SELL_AMT = $request->input('salesUnitAmount');
            $salesFolderGroup->SELL_TTAX_AMT = 0;
            $salesFolderGroup->SELL_DISC_AMT = $request->input('salesDiscountAmount');
            $salesFolderGroup->SELL_DISC_PERC = $request->input('salesDiscountRate');
            $salesFolderGroup->SELL_COMM_AMT = $request->input('salesCommissionAmount');
            $salesFolderGroup->SELL_COMM_PERC = $request->input('salesCommissionRate');
            $salesFolderGroup->SELL_INS_AMT = 0;
            $salesFolderGroup->SELL_SURCHARGE = $request->input('salesSurcharge');
            $salesFolderGroup->TTL_SELL_AMT = $request->input('salesTotalUnitAmount');
            $salesFolderGroup->SELL_GRAND_TOTAL = $request->input('salesGrandTotal');
            $salesFolderGroup->PUBLISH_AMT = 0;
            $salesFolderGroup->SPL_FARE_CODE = 0;
            $salesFolderGroup->NETT_AMT = 0;
            $salesFolderGroup->NET_FARE_FLAG = 'N';
            $salesFolderGroup->NAIR_NETT_AMT = 0;
            $salesFolderGroup->COST_COMM_AMT = $request->input('costCommissionAmount');
            $salesFolderGroup->COST_COMM_PERC = $request->input('costCommissionRate');
            $salesFolderGroup->COST_DISC_AMT = $request->input('costDiscountAmount');
            $salesFolderGroup->COST_DISC_PERC = $request->input('costDiscountRate');
            $salesFolderGroup->COST_TTAX_AMT = $request->input('costTax');
            $salesFolderGroup->COST_INS_AMT = 0;
            $salesFolderGroup->COST_CURR_CODE = $request->input('costCurrencyCode');
            $salesFolderGroup->COST_CURR_RATE = $request->input('costCurrencyAmount');
            $salesFolderGroup->TTL_COST_AMT = $request->input('costTotalUnitCost');
            $salesFolderGroup->COST_GRAND_TOTAL = $request->input('costGrandTotal');
            $salesFolderGroup->INCOME = 0;
            $salesFolderGroup->SELL_AMT_1 = 0;
            $salesFolderGroup->SELL_AMT_2 = 0;
            $salesFolderGroup->SELL_AMT_3 = 0;
            $salesFolderGroup->SELL_AMT_4 = 0;
            $salesFolderGroup->SELL_AMT_5 = 0;
            $salesFolderGroup->CURR_CODE_1 = 'PHP';
            $salesFolderGroup->CURR_CODE_2 = 'PHP';
            $salesFolderGroup->CURR_CODE_3 = 'PHP';
            $salesFolderGroup->CURR_CODE_4 = 'PHP';
            $salesFolderGroup->CURR_CODE_5 = 'PHP';
            $salesFolderGroup->CURR_RATE_1 = 1.00;
            $salesFolderGroup->CURR_RATE_2 = 1.00;
            $salesFolderGroup->CURR_RATE_3 = 1.00;
            $salesFolderGroup->CURR_RATE_4 = 1.00;
            $salesFolderGroup->CURR_RATE_5 = 1.00;
            $salesFolderGroup->SUPP_ID = null;
            $salesFolderGroup->ACCT_CODE = null;
            $salesFolderGroup->XO_NO = null;
            $salesFolderGroup->VOUCHER_NO = null;
            $salesFolderGroup->MPD_TICKET_NO = null;
            $salesFolderGroup->TOUR_CODE = null;
            $salesFolderGroup->BULK_FLAG = 'N';
            $salesFolderGroup->ETICKET_FLAG = 'N';
            $salesFolderGroup->GDS_PROVIDER = null;
            $salesFolderGroup->SHORT_DESCR = null;
            $salesFolderGroup->LONG_DESCR = $request->input('longItineraryDesc');
            $salesFolderGroup->REMARKS = $request->input('generalRemarks');
            $salesFolderGroup->AIRLINE_REMARKS = $request->input('airlineReference');
            $salesFolderGroup->PRINT_LONG_DESCR = 'N';
            $salesFolderGroup->CASH_INV_CNT = 0;
            $salesFolderGroup->CREDIT_INV_CNT = 1;
            $salesFolderGroup->CHARGE_INV_CNT = 0;
            $salesFolderGroup->UATP_INV_CNT = 0;
            $salesFolderGroup->MIX_INV_CNT = 0;
            $salesFolderGroup->CAV_CNT = 0;
            $salesFolderGroup->BYPASS_FLAG = 'N';
            $salesFolderGroup->SUPRESS_PRINT = 'N';
            $salesFolderGroup->PAX_DESCR = null;
            $salesFolderGroup->PRINT_PAX_DESCR = 'N';
            $salesFolderGroup->FIRST_PAX_NAME = null;
            $salesFolderGroup->SECOND_PAX_NAME = null;
            $salesFolderGroup->PKG_FLAG = 'N';
            $salesFolderGroup->GROUP_FLAG = 'N';
            $salesFolderGroup->XO_AMT = 0;
            $salesFolderGroup->INV_AMT = 0;
            $salesFolderGroup->CAV_AMT = 0;
            $salesFolderGroup->SELL_BAL_AMT = 0;
            $salesFolderGroup->COST_BAL_AMT = 0;
            $salesFolderGroup->SHOW_CONV = 'N';
            $salesFolderGroup->FARE_SAVE_AMT = 0;
            $salesFolderGroup->STAFF_DISC_PERC = 0;
            $salesFolderGroup->STAFF_DISC_AMT = 0;
            $salesFolderGroup->PROMO_ALLOC = 0;
            $salesFolderGroup->ADM_ALLOC = 0;
            $salesFolderGroup->LOWEST_FARE = 0;
            $salesFolderGroup->IATA_FARE = 0;

            $salesFolderGroup->save();

            Log::info('SalesFolderGroup saved successfully', ['salesFolderGroup' => $salesFolderGroup]);

            return response()->json(['message' => 'Sales Folder Group saved successfully'], 201);
        } catch (\Exception $e) {
            Log::error('Failed to save SalesFolderGroup', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to save Sales Folder Group', 'error' => $e->getMessage()], 500);
        }
    }
}
