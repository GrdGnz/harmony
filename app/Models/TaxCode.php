<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCode extends Model
{
    use HasFactory;

    protected $table = 'TAX_CODE';

    protected $fillable = [
      'TAX_CODE',
      'TAX_DESCR',
      'STATUS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];
}
