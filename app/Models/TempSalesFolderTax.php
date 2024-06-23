<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSalesFolderTax extends Model
{
    use HasFactory;

    protected $table = 'TEMP_SALES_FOLDER_TAX';

    public $timestamps = false;

    protected $fillable = [
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
    ];
}
