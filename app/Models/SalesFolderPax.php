<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderPax extends Model
{
    use HasFactory;

    protected $table = 'SALES_FOLDER_PAX';

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
      'ITEM_NO',
      'PROD_CAT',
      'DOC_FLAG',
      'PAX_NAME',
      'PAX_ID',
      'TICKET_NO',
      'CONJUNCT_COUNT',
      'CAV_NO',
      'SELL_BAL_AMT',
      'COST_BAL_AMT',
      'CASH_INV_CNT',
      'CREDIT_INV_CNT',
      'CHARGE_INV_CNT',
      'UATP_INV_CNT',
      'PASSPORT_NUMBER',
      'PASSPORT_ISSUE',
      'PASSPORT_EXPIRY',
      'VISA_NO',
      'VISA_ISSUE',
      'VISA_EXPIRY',
      'NATIONALITY',
      'REMARKS',
      'ORIGIN',
      'SEL',
      'UPDATE_SOURCE',
      'OEC',
      'OEC_DATE',
      'PNR',
      'GDS_PROVIDER',
      'DUE_DATE',
    ];

    public $timestamps = false;
}
