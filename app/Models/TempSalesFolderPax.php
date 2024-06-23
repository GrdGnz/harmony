<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSalesFolderPax extends Model
{
    use HasFactory;

    protected $table = 'TEMP_SALES_FOLDER_PAX';

    public $timestamps = false;

    protected $primaryKey = 'TICKET_NO';

    public $incrementing = false;

    protected $fillable = [
      'SF_NO',
      'DOC_ID',
      'PROD_CAT',
      'PAX_NAME',
      'TICKET_NO',
      'PNR',
    ];

}
