<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'CLIENT';

    protected $fillable = [
        'CLT_ID',
        'CLT_TYPE',
        'STATUS',
        'CLT_CODE',
        'FULL_NAME',
        'CATEGORY',
        'MAIL_ADDRESS',
        'PHONE_NO_1',
        'FAX_NO_1',
    ];

    public function category()
    {
        return $this->belongsTo(ClientCategory::class, 'CATEGORY', 'id');
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
        return $this->belongsTo(NameContact::class, 'CLT_ID', 'NAME_ID');
    }
}
