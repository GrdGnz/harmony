<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesType extends Model
{
    use HasFactory;

    protected $table = 'SALES_TYPE';

    protected $fillable = [
        'SALES_TYPE',
        'SALES_DESCR',
        'STATUS',
        'ACCT_CODE_LOCAL',
        'ACCT_CODE_FOREIGN',
    ];
}
