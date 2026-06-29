<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyNews extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'url',
        'source',
        'published_date',
        'summary',
        'sentiment',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
