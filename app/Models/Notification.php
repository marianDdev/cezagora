<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name', //eg: membership invitation email
        'channel', //email or sms
        'receiver_name',
        'receiver_email', //in case of membership invitation email we don't have a user yet
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
