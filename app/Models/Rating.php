<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['reviewee_id', 'reviewer_id', 'rating', 'comment'];

    public function reviewee()
    {
        return $this->belongsTo(Company::class, 'reviewee_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Company::class, 'reviewer_id');
    }
}
