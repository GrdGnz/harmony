<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCategory extends Model
{
    use HasFactory;

    protected $table = 'CLIENT_CATEGORY';

    protected $fillable = [
        'code',
        'name',
    ];
}
