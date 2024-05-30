<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $table = 'VESSEL';

    protected $fillable = [
      'VESSEL_CODE',
      'VESSEL_NAME',
      'GROSS_TONNAGE',
      'OPERATOR',
      'PRINCIPAL_NAME',
      'PRINCIPAL',
      'PHONE_NO',
      'FAX_NO',
      'EMAIL',
      'WEBSITE',
      'CONTACT_NAME',
      'LOC_NO',
      'KNOT_SPEED',
      'METER_LENGTH',
      'METER_WIDTH',
      'BUILT_DATE',
      'REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
      'LINK_CODE',
    ];
}
