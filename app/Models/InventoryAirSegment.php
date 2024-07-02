<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAirSegment extends Model
{
    use HasFactory;

    protected $table = 'INVENTORY_AIR_SEGMENT';

    protected $fillable = [
      'PROD_CAT',
      'TICKET_NO',
      'ITEM_NO',
      'AL_CODE',
      'FLIGHT_NUM',
      'DEST_CITY',
      'DEST_DATE',
      'DEST_TIME',
      'ORIG_CITY',
      'ORIG_DATE',
      'ORIG_TIME',
      'SERVICE_CLASS',
      'STATUS',
      'SEG_CURR_CODE',
      'SEG_CURR_RATE',
      'SEG_AMOUNT',
      'MILEAGE',
      'STOP_OVER_1',
      'STOP_OVER_2',
      'STOP_OVER_3',
      'MEAL_CODE_1',
      'MEAL_CODE_2',
      'MEAL_CODE_3',
      'SEAT_CODE_1',
      'SEAT_CODE_2',
      'SEAT_CODE_3',
      'EQUIPMENT',
      'FARE_BASIS',
      'ORIGIN',
      'UPDATE_SOURCE',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'TICKET_NO', 'TICKET_NO');
    }

}
