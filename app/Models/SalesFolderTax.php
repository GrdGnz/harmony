<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderTax extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $table = 'SALES_FOLDER_TAX';

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
      'ITEM_NO',
      'TAX_CODE',
      'TAX_NUM',
      'COST_CURR_CODE',
      'COST_CURR_RATE',
      'COST_AMOUNT',
      'SELL_CURR_CODE',
      'SELL_CURR_RATE',
      'SELL_AMOUNT',
      'BILL_FLAG',
      'INCL_FLAG',
      'DISC_PERC',
      'DISC_AMOUNT',
      'REMARKS',
      'ORIGIN',
      'SEL',
      'UPDATE_SOURCE',
      'COST_COMM_AMOUNT',
    ];
}
