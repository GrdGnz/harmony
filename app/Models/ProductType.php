<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'PRODUCT_TYPE';

    protected $fillable = [
        'PROD_TYPE',
        'PROD_DESCR',
        'STATUS',
        'TAX_TYPE',
        'PROD_CAT',
        'ROUTE',
        'GL_ACCT_LOCAL',
        'GL_ACCT_FOREIGN',
        'REMARKS',
        'CRT_BY',
        'CRT_DATE',
        'REV_BY',
        'REV_DATE',
        'SELL_CURR',
        'COST_CURR',
        'DOM_ACCT_LOCAL',
        'DOM_ACCT_FOREIGN',
        'INTL_ACCT_LOCAL',
        'INTL_ACCT_FOREIGN',
        'RGNL_ACCT_LOCAL',
        'RGNL_ACCT_FOREIGN',
        'TBDR_ACCT_LOCAL',
        'TBDR_ACCT_FOREIGN',
        'SREV_ACCT_LOCAL',
        'SREV_ACCT_FOREIGN',
        'SDSC_ACCT_LOCAL',
        'SDSC_ACCT_FOREIGN',
        'PCHS_ACCT_LOCAL',
        'PCHS_ACCT_FOREIGN',
        'PDSC_ACCT_LOCAL',
        'PDSC_ACCT_FOREIGN',
        'CEXP_ACCT_LOCAL',
        'CEXP_ACCT_FOREIGN',
        'REQ_XO_INV',
        'HOTEL_QTY_FACTOR',
    ];

    public function category()
    {
        $this->belongsTo(ProductCategory::class, 'PROD_CAT', 'PROD_CAT');
    }

    public function route()
    {
        $this->belongsTo(Route::class, 'ROUTE', 'ROUTE_CODE');
    }
}
