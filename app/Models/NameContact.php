<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameContact extends Model
{
    use HasFactory;

    protected $table = 'NAME_CONTACT';

    protected $fillable = [
        'NAME_ID',
        'NAME_TYPE',
        'ITEM_NO',
        'CONTACT_NAME',
        'POS_CODE',
        'PHONE_NO',
        'FAX_NO',
        'MOBILE_NO',
        'EMAIL',
        'DEPT_CODE',
        'REMARKS',
        'CRT_BY',
        'CRT_DATE',
        'REV_BY',
        'REV_DATE',
        'LOC_NO',
        'HOST_UPLOAD',
        'DEF_FLAG',
    ];
}
