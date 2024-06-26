<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolder extends Model
{
    use HasFactory;

    protected $table = 'SALES_FOLDER';

    protected $fillable = [
        'SF_NO',
        'MNL_SF_NO',
        'SF_DATE',
        'DUE_DATE',
        'STATUS',
        'CLT_TYPE',
        'CLT_ID',
        'CLT_CODE',
        'CLT_NAME',
        'CLT_CAT',
        'CREDIT_TERM',
        'DAYS_DUE',
        'BILL_TO_COY',
        'CLT_DEPT_CODE',
        'CLT_PHONE_NO',
        'CLT_FAX_NO',
        'CLT_EMAIL',
        'CLT_ADDRESS',
        'CLT_XO_NO',
        'CLT_XO_DATE',
        'CLT_CONTACT',
        'SALES_TYPE',
        'TRANS_DEPT',
        'TRIP_DATE',
        'TRANS_PHONE_NO',
        'TRANS_FAX_NO',
        'TRANS_EMAIL',
        'TRANS_CONTACT',
        'TRA_NO',
        'TRA_DATE',
        'BILL_CURR_CODE',
        'BILL_CURR_RATE',
        'FOREIGN_CURR_CODE',
        'FOREIGN_CURR_RATE',
        'TTL_AMT',
        'PREF_FOP',
        'CARD_TYPE',
        'CARD_NO',
        'CARD_COY',
        'CARD_RATE',
        'CARD_ISSUE',
        'CARD_EXPIRY',
        'CARD_NAME',
        'CARD_BANK',
        'CARD_APPROVAL',
        'CARD_RECAP_NO',
        'CARD_ESTB_NO',
        'CARD_CINV_NO',
        'SALES_AGENT',
        'BOOKED_BY',
        'TICKETED_BY',
        'FIRST_PAX_NAME',
        'SECOND_PAX_NAME',
        'PAX_CNT',
        'PNR',
        'INV_AMT',
        'INV_DISC_PERC',
        'INV_DISC_AMT',
        'PROD_DEPT_CODE',
        'WKGP_CODE',
        'BRANCH',
        'SEC_STATUS',
        'DEPT_CODE',
        'TRANS_COUNT',
        'RCPT_NO',
        'PRINT_CNT',
        'TKT_TIME_LIMIT',
        'REMARKS_SALES_FOLDER',
        'REMARKS_INVOICE',
        'REMARKS_EXCHANGE_ORDER',
        'REMARKS_CASH_ADVANCES',
        'CRT_BY',
        'REV_BY',
        'ORIGIN',
        'crt_date',
        'rev_date',
        'BOOK_YEAR',
        'BOOK_PERIOD',
        'BOOK_STATUS',
        'ALT_REMARKS',
        'PRESET_REMARKS',
        'CLT_OPRN_CONTINENT',
        'CLT_OPRN_REGION',
        'CLT_OPRN_COUNTRY',
        'CLT_OPRN_CITY',
        'CLT_OPRN_LOCATION',
        'CLT_OPRN_DEPARTMENT',
        'BANK_CARD_RATE',
        'LAST_DOC_ID',
        'LONG_SF_NO',
        'EBC_NO_SOURCE',
        'LAST_PAX_ITEM',
        'LAST_AIR_ITEM',
        'LAST_TAX_ITEM',
        'LAST_HOTEL_ITEM',
        'LAST_CAR_ITEM',
        'LAST_TRANSFER_ITEM',
        'LAST_MISC_ITEM',
        'LAST_COMM_ITEM',
    ];

    // Disable Laravel's timestamps
    public $timestamps = false;

    public function contact()
    {
        return $this->belongsTo(NameContact::class, 'CLT_ID', 'NAME_ID');
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class, 'CLT_TYPE', 'code');
    }
}
