<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderGroup extends Model
{
    use HasFactory;

    protected $table = 'SALES_FOLDER_GROUP';

    protected $primaryKey = null;

    public $timestamps = false;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
      'PROD_TYPE',
      'PROD_CAT',
      'PNR',
      'AL_PNR',
      'AL_CODE',
      'FORM_TYPE',
      'PTC',
      'ROUTE',
      'QTY',
      'TAX_TYPE',
      'TAX_AMT',
      'TAX_RATE',
      'CHARGE_AMT',
      'SELL_CURR_CODE',
      'SELL_CURR_RATE',
      'SELL_AMT',
      'SELL_TTAX_AMT',
      'SELL_DISC_AMT',
      'SELL_DISC_PERC',
      'SELL_COMM_AMT',
      'SELL_COMM_PERC',
      'SELL_INS_AMT',
      'SELL_SURCHARGE',
      'TTL_SELL_AMT',
      'SELL_GRAND_TOTAL',
      'PUBLISH_AMT',
      'SPL_FARE_CODE',
      'NETT_AMT',
      'NET_FARE_FLAG',
      'NAIR_NETT_AMT',
      'COST_COMM_AMT',
      'COST_COMM_PERC',
      'COST_DISC_AMT',
      'COST_DISC_PERC',
      'COST_TTAX_AMT',
      'COST_INS_AMT',
      'COST_CURR_CODE',
      'COST_CURR_RATE',
      'TTL_COST_AMT',
      'COST_GRAND_TOTAL',
      'INCOME',
      'SELL_AMT_1',
      'SELL_AMT_2',
      'SELL_AMT_3',
      'SELL_AMT_4',
      'SELL_AMT_5',
      'CURR_CODE_1',
      'CURR_CODE_2',
      'CURR_CODE_3',
      'CURR_CODE_4',
      'CURR_CODE_5',
      'CURR_RATE_1',
      'CURR_RATE_2',
      'CURR_RATE_3',
      'CURR_RATE_4',
      'CURR_RATE_5',
      'SUPP_ID',
      'ACCT_CODE',
      'XO_NO',
      'VOUCHER_NO',
      'MPD_TICKET_NO',
      'TOUR_CODE',
      'BULK_FLAG',
      'ETICKET_FLAG',
      'GDS_PROVIDER',
      'SHORT_DESCR',
      'LONG_DESCR',
      'REMARKS',
      'AIRLINE_REMARKS',
      'PRINT_LONG_DESCR',
      'CASH_INV_CNT',
      'CREDIT_INV_CNT',
      'CHARGE_INV_CNT',
      'UATP_INV_CNT',
      'MIX_INV_CNT',
      'CAV_CNT',
      'BYPASS_FLAG',
      'SUPRESS_PRINT',
      'PAX_DESCR',
      'PRINT_PAX_DESCR',
      'FIRST_PAX_NAME',
      'SECOND_PAX_NAME',
      'PKG_FLAG',
      'GROUP_FLAG',
      'XO_AMT',
      'INV_AMT',
      'CAV_AMT',
      'SELL_BAL_AMT',
      'COST_BAL_AMT',
      'SHOW_CONV',
      'FARE_SAVE_AMT',
      'STAFF_DISC_PERC',
      'STAFF_DISC_AMT',
      'PROMO_ALLOC',
      'ADM_ALLOC',
      'FARE_CALC',
      'POINT_EMBARK',
      'POINT_DISEMBARK',
      'EMBARK_DATE',
      'DISEMBARK_DATE',
      'VESSEL_NAME',
      'PRINCIPAL',
      'PRINCIPAL_REMARKS',
      'PRINT_EMBARK_REMARKS',
      'FARE_SAVE_CODE',
      'LOWEST_FARE',
      'IATA_FARE',
      'REGION',
      'LONG_HAUL',
      'NUC',
      'ROE',
      'RTT',
      'PTA',
      'OEC',
      'ORIGIN',
      'BOOKED_AGENT_ID',
      'BOOKED_USER_ID',
      'BOOKED_DATE',
      'ISSUED_AGENT_ID',
      'ISSUED_USER_ID',
      'ISSUED_DATE',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
      'CONF_NO',
      'PAX_REF_NO',
      'SEL',
      'CONJUNCT_COUNT',
      'UPDATE_SOURCE',
      'ALLOC_COMM_AMT',
      'DOC_FLAG',
      'COST_TTAX_COMM_AMT',
      'GROUP_PRODUCT',
      'GROUP_ID',
      'COMB_DUP_TAX',
      'PORT_CODE',
      'PAX_VESSEL_ROUTE',
      'PAX_BATCH_NO',
      'PRINT_ORIG_PNR',
      'TAX_TYPE_INFO',
      'DISC_SOURCE_VALUE',
      'DISC_AR_POSTING',
      'SUPP_COMM_AR',
    ];

    public function product()
    {
        return $this->belongsTo(ProductType::class, 'PROD_TYPE', 'PROD_TYPE');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'PROD_CAT', 'PROD_CAT');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'ROUTE', 'ROUTE_CODE');
    }
}
