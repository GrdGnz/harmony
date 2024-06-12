<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSalesFolderAir extends Model
{
    use HasFactory;

    protected $table = 'TEMP_SALES_FOLDER_AIR';

    protected $fillable = [
        'SF_NO',
        'DOC_ID',
        'AL_CODE',
        'FLIGHT_NUM',
        'DEPT_CITY',
        'DEPT_DATE',
        'DEPT_TIME',
        'ARVL_CITY',
        'ARVL_DATE',
        'ARVL_TIME',
        'SERVICE_CLASS',
    ];
}
