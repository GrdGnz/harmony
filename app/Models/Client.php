<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'CLIENT';

    protected $fillable = [
        'CLT_TYPE',
        'STATUS',
        'CLT_CODE',
        'FULL_NAME',
        'CATEGORY',
        'MAIL_ADDRESS',
        'PHONE_NO_1',
        'FAX_NO_1',
        'FAX_NO_1',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\ClientCategory::class, 'CATEGORY');
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\ClientType::class, 'CLT_TYPE');
    }

    public function salesAgent()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'AGENT_ASSIGNED', 'EMP_ID');
    }

    public function contact()
    {
        return $this->belongsTo(\App\Models\NameContact::class, 'CLT_ID', 'NAME_ID');
    }
}
