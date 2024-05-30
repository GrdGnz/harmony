<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderTransfer extends Model
{
    use HasFactory;

    protected $table = 'SALES_FOLDER_TRANSFER';

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
      'CAR_PROVIDER',
      'CAR_TYPE',
      'CAR_CAT',
      'MOVE_TYPE',
      'CITY_CODE',
      'MOVE_TIME',
      'FLIGHT_NUM',
      'PICK_DATE',
      'PICK_TIME',
      'PICK_LOC',
      'DROP_DATE',
      'DROP_TIME',
      'DROP_LOC',
      'VIP_FLAG',
      'STOP_OVER_1',
      'STOP_OVER_2',
      'STOP_OVER_3',
      'PHONE_NO',
      'MOBILE_NO',
      'EMAIL',
      'SPECIAL_REQUEST',
      'STATUS',
      'ORIGIN',
      'UPDATE_SOURCE',
    ];
}
