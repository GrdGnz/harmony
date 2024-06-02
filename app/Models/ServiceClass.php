<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceClass extends Model
{
    use HasFactory;

    protected $table = 'SERVICE_CLASS';

    protected $fillable = [
      'SRVC_CLASS',
      'SRVC_DESCR',
      'CATEGORY',
      'REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];
}
