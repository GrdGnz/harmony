<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCar extends Model
{
    use HasFactory;

    protected $table = 'INVENTORY_CAR';

    protected $fillable = [
      'PROD_CAT',
      'VOUCHER_NO',
      'CAR_PROVIDER',
      'CAR_TYPE',
      'CAR_CAT',
      'START_DATE',
      'START_TIME',
      'START_LOC',
      'END_DATE',
      'END_TIME',
      'END_LOC',
      'STATUS',
      'ORIGIN',
    ];
}
