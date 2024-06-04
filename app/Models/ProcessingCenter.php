<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingCenter extends Model
{
    use HasFactory;

    protected $table = 'PROCESSING_CENTER';

    protected $fillable = [
      'PROC_CODE',
      'PROC_DESCR',
      'STATUS',
      'REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];

}
