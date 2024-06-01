<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMisc extends Model
{
    use HasFactory;

    protected $table = 'INVENTORY_MISC';

    protected $fillable = [
      'PROD_CAT',
      'VOUCHER_NO',
      'MISC_CODE',
      'START_DATE',
      'START_TIME',
      'START_LOC',
      'END_DATE',
      'END_TIME',
      'END_LOC',
      'SERVICE_CLASS',
      'STATUS',
      'ADDITIONAL_SERVICE',
      'REMARKS',
      'ORIGIN',
    ];
}
