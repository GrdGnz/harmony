<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderAir extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $primaryKey = ['SF_NO', 'DOC_ID', 'ITEM_NO']; // Specify composite primary key

    public $incrementing = false; // Disable auto-incrementing for composite key

    protected $table = 'SALES_FOLDER_AIR';

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
      'ITEM_NO',
      'AL_CODE',
      'FLIGHT_NUM',
      'DEPT_CITY',
      'DEPT_DATE',
      'DEPT_TIME',
      'ARVL_CITY',
      'ARVL_DATE',
      'ARVL_TIME',
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
      'ORIGIN',
      'FARE_BASIS',
      'UPDATE_SOURCE',
    ];

    /**
     * Override the method to get the primary key value
     */
    public function getKeyName()
    {
        return ['SF_NO', 'DOC_ID', 'ITEM_NO'];
    }
}
