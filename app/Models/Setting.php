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
    public const TRANSACTION_FEE_PERCENTAGE = 'transaction_fee_percentage';
    public const DEFAULT_CURRENCY = 'eur';

    protected $fillable = ['name', 'value'];
}
