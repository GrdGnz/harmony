<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $table = 'AIRLINE';

    protected $fillable = [
      'AL_CODE',
      'AL_DESCR',
      'AL_NUM',
      'ISO_NO',
      'STATUS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];
}
