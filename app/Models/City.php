<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'CITY';

    protected $fillable = [
      'CITY_CODE',
      'CITY_DESCR',
      'STATUS',
      'CTRY_CODE',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'CTRY_CODE', 'CTRY_CODE');
    }
}
