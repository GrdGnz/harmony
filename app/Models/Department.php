<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'DEPARTMENT';

    protected $fillable = [
      'DEPT_CODE',
      'DEPT_DESCR',
      'COST_NO',
      'REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];
}
