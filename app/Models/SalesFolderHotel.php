<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderHotel extends Model
{
    use HasFactory;

    protected $table = 'SALES_FOLDER_HOTEL';

    protected $primaryKey = null;

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
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
      'OTHER_SERVICE',
      'MEAL_CODE_1',
      'MEAL_CODE_2',
      'MEAL_CODE_3',
      'STATUS',
      'REMARKS',
      'ORIGIN',
      'UPDATE_SOURCE',
      'ROOM_QTY',
    ];

    public function hotel()
    {
        $this->belongsTo(Hotel::class, 'HOTEL_CODE', 'HOTEL_CODE');
    }

    public $timestamps = false;
}
