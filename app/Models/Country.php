<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'COUNTRY';

    protected $fillable = [
      'CTRY_CODE',
      'CTRY_DESCR',
      'CURR_CODE',
      'NATIONALITY_DESCR',
      'RGN_CODE',
      'CTNT_CODE',
      'CAPITAL',
      'ISO_NO',
      'STATUS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];
}
