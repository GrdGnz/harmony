<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'HOTEL';

    protected $fillable = [
      'HOTEL_CODE',
      'HOTEL_DESCR',
      'HCHN_CODE',
      'ADDRESS',
      'STREET_DESCR',
      'CITY_CODE',
      'CTRY_CODE',
      'PHONE_NO_1',
      'PHONE_NO_2',
      'PHONE_NO_3',
      'FAX_NO_1',
      'FAX_NO_2',
      'FAX_NO_3',
      'EMAIL',
      'WEBSITE',
      'STATUS',
      'REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
      'ZIP_CODE',
      'CATEGORY',
      'LOC_NO',
      'GRADE_LEVEL',
    ];
}
