<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTax extends Model
{
    use HasFactory;

    protected $table = 'INVENTORY_TAX';

    protected $fillable = [
      'PROD_CAT]',
      'TICKET_NO]',
      'ITEM_NO]',
      'TAX_CODE]',
      'TAX_NUM]',
      'COST_CURR_CODE]',
      'COST_CURR_RATE]',
      'COST_AMOUNT]',
      'SELL_CURR_CODE]',
      'SELL_CURR_RATE]',
      'SELL_AMOUNT]',
      'BILL_FLAG]',
      'INCL_FLAG]',
      'DISC_PERC]',
      'DISC_AMOUNT]',
      'REMARKS]',
      'ORIGIN]',
      'COST_COMM_AMOUNT]',
    ];
}
