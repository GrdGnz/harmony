<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderCar extends Model
{
    use HasFactory;

    protected $table = 'SALES_FOLDER_CAR';

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
      'CAR_PROVIDER',
      'CAR_TYPE',
      'CAR_CAT',
      'START_DATE',
      'START_TIME',
      'START_LOC',
      'END_DATE',
      'END_TIME',
      'END_LOC',
      'DAY_COUNT',
      'STATUS',
      'ORIGIN',
      'UPDATE_SOURCE',
    ];
}
