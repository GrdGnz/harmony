<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use HasFactory;

    protected $table = 'MEAL_TYPE';

    protected $fillable = [
      'MEAL_CODE',
      'MEAL_DESCR',
      'STATUS',
      'REMARKS',
      'CRT_BY',
      'CRT_DATE',
      'REV_BY',
      'REV_DATE',
    ];
}
