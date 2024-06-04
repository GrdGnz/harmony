<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscellaneousRates extends Model
{
    use HasFactory;

    protected $table = 'MISCELLANEOUS_RATES';

    protected $fillable = [
      'MISC_CODE',
      'MISC_DESCR',
      'PROD_TYPE',
      'SELL_CURR_CODE',
      'SELL_AMOUNT',
      'COST_CURR_CODE',
      'COST_AMOUNT',
      'SUPP_ID',
      'ACCT_CODE',
      'DOC_FLAG',
      'DOC_CAT',
      'PROC_CODE',
      'DOC_OFFICER',
      'CTRY_CODE',
      'STATUS',
      'REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
      'FILTER_ON_PRODUCT_TYPE',
    ];
}
