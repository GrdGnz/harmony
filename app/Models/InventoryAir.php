<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAir extends Model
{
    use HasFactory;

    protected $table = 'INVENTORY_AIR';

    protected $fillable = [
      'PROD_CAT',
      'TICKET_NO',
      'SEC_TICKET_NO',
      'AL_PNR',
      'SUPPORT_DOC',
      'AL_CODE',
      'CONJUNCT_FLAG',
      'CONJUNCT_COUNT',
      'MPD_FLAG',
      'BULK_FLAG',
      'ETICKET_FLAG',
      'FARE_CALC',
      'OEC',
      'OEC_DATE',
      'RTT',
      'PTA',
      'ORIGIN',
    ];
}
