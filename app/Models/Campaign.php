<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', //useful for knowing which promotion is applied (transaction without fees,; 20% discount for the fee, signup bonus etc)
        'start_at',
        'end_at',
        'limit', //how many times a company has the right to benefit from the promotion
    ];
}
