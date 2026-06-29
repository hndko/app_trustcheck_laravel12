<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyMetric extends Model
{
    protected $fillable = [
        'company_id',
        'review_score',
        'news_score',
        'website_score',
        'digital_presence_score',
        'positive_topics',
        'negative_topics',
        'website_health',
    ];

    protected $casts = [
        'positive_topics' => 'array',
        'negative_topics' => 'array',
        'website_health' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
