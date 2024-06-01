<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryHotel extends Model
{
    use HasFactory;

    protected $table = 'INVENTORY_HOTEL';

    protected $fillable = [
      'PROD_CAT',
      'VOUCHER_NO',
      'HOTEL_CODE',
      'CITY_CODE',
      'HOTEL_LOC',
      'ROOM_TYPE',
      'ROOM_CAT',
      'CHECKIN_DATE',
      'CHECKIN_TIME',
      'CHECKOUT_DATE',
      'CHECKOUT_TIME',
      'NIGHT_NO',
      'VIP_FLAG',
      'GUEST_QTY',
      'MEAL_CODE_1',
      'MEAL_CODE_2',
      'MEAL_CODE_3',
      'STATUS',
      'REMARKS',
      'OTHER_SERVICE',
      'ORIGIN',
      'ROOM_QTY',
    ];
}
