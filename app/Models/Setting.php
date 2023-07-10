<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $transaction_fee
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value'];
}
