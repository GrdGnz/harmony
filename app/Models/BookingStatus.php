<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    use HasFactory;

    protected $table = 'BOOKING_STATUS';

    protected $fillable = [
      'BK_CODE',
      'BK_DESCR',
      'REMARKS',
      'CATEGORY',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];
}
