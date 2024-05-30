<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = "PRODUCT_CATEGORY";

    protected $fillable = [
        'prod_cat',
        'prod_name',
        'status',
    ];
}
