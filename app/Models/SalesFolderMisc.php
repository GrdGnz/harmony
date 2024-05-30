<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesFolderMisc extends Model
{
    use HasFactory;

    protected $table = 'SALES_FOLDER_MISC';

    protected $fillable = [
        'SF_NO',
        'DOC_ID',
        'MISC_CODE',
        'MISC_CAT',
        'DOC_FLAG',
        'PROC_CENTER',
        'DOC_OFFICER',
        'START_DATE',
        'START_TIME',
        'START_LOC',
        'END_DATE',
        'END_TIME',
        'END_LOC',
        'SERVICE_CLASS',
        'ADDITIONAL_SERVICE',
        'STATUS',
        'REMARKS',
        'ORIGIN',
        'UPDATE_SOURCE] ',
    ];
}
