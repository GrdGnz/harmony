<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $table = 'INVENTORY';

    protected $fillable = [
      'PROD_CAT',
      'TICKET_NO',
      'PROD_TYPE',
      'PNR',
      'SUPPORT_DOC',
      'SUPP_ID',
      'MPD_TICKET_NO',
      'ROUTE_TYPE',
      'RECEIVED_BY',
      'DR_NO',
      'DR_DATE',
      'REGION_CODE',
      'GROUP_BOOK_FLAG',
      'SPLIT_COUNT',
      'WKGP_CODE',
      'DEPT_CODE',
      'BR_CODE',
      'SF_NO',
      'DOC_ID',
      'ITEM_NO',
      'OR_NO',
      'OR_TYPE',
      'PO_NO',
      'RFND_NO',
      'FIRST_PAX_NAME',
      'FIRST_PAX_ID',
      'FIRST_PAX_TITLE',
      'SECOND_PAX_NAME',
      'SECOND_PAX_ID',
      'SECOND_PAX_TITLE',
      'DEPART_DATE',
      'ISSUE_DATE',
      'COST_CURR_CODE',
      'COST_CURR_RATE',
      'SPL_FARE_CODE',
      'PUBLISH_AMOUNT',
      'ANET_AMOUNT',
      'ONET_AMOUNT',
      'NET_FLAG',
      'COST_DISC_PERC',
      'COST_DISC_AMOUNT',
      'COST_COMM_PERC',
      'COST_COMM_AMOUNT',
      'COST_INS_AMOUNT',
      'COST_TAX_AMOUNT',
      'OTHER_COST_AMOUNT',
      'QTY',
      'TTL_COST_AMOUNT',
      'SELL_CURR_CODE',
      'SELL_CURR_RATE',
      'SELL_AMOUNT',
      'SELL_TAX_AMOUNT',
      'SELL_DISC_PERC',
      'SELL_DISC_AMOUNT',
      'SELL_COMM_PERC',
      'SELL_COMM_AMOUNT',
      'SELL_INS_AMOUNT',
      'OTHER_SELL_AMOUNT',
      'GOVT_TAX_TYPE',
      'GOVT_TAX_AMOUNT',
      'GOVT_TAX_PERC',
      'SURCHARGE_PERC',
      'SURCHARGE_AMOUNT',
      'TTL_SELL_AMOUNT',
      'CONF_NO',
      'PAX_REF_NO',
      'PAX_PTC',
      'FORM_TYPE',
      'AGT_BKG_ID',
      'AGT_BKG_DATE',
      'AGT_BKG_LOC',
      'AGT_INV_ID',
      'AGT_INV_DATE',
      'AGT_INV_LOC',
      'STATUS',
      'ORIGIN',
      'STOCK_TYPE',
      'HOST_CREATE_ID',
      'SHORT_ITIN_DESCR',
      'LONG_ITIN_DESCR',
      'REMARKS',
      'CLT_NAME_TYPE',
      'CLT_NAME_ID',
      'CLT_NAME',
      'REISSUED_REMARKS',
      'LOG_REMARKS',
      'RESERVED_TO',
      'RESERVED_BY',
      'RESERVED_REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
      'GDS_PROVIDER',
      'TOUR_CODE',
      'PROMO_NAME',
      'VALID_START',
      'VALID_END',
      'REINSTATE_BY',
      'REINSTATE_REMARKS',
      'VOID_TYPE',
      'VOID_BY',
      'VOID_PERIOD',
      'VOID_REMARKS',
      'VOID_HOST_USER',
      'SELF_REFUND_NO',
      'BOOK_DATE',
      'INCOME',
      'AL_PNR',
      'FARE_CALC',
      'SEQ_NUMBER',
      'MPD_FLAG',
      'COST_TTAX_COMM_AMT',
      'ITD_TYPE',
      'SEL',
      'DISC_SOURCE_VALUE',
      'DISC_AR_POSTING',
      'SUPP_COMM_AR',
      'CLT_OPRN_CONTINENT',
      'CLT_OPRN_REGION',
      'CLT_OPRN_COUNTRY',
      'CLT_OPRN_CITY',
      'CLT_OPRN_LOCATION',
      'CLT_OPRN_DEPARTMENT',
      'EVENT_ITEM_NO',
      'ORIG_HOST_FILE',
      'INV_NO',
      'INV_TYPE',
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'PROD_TYPE', 'PROD_TYPE');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'PROD_CAT', 'PROD_CAT');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'ROUTE_TYPE', 'ROUTE_CODE');
    }

    public function airSegments()
    {
        return $this->hasMany(InventoryAirSegment::class, 'TICKET_NO', 'TICKET_NO');
    }
}
