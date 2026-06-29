<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanySource extends Model
{
    protected $fillable = [
        'company_id',
        'source_name',
        'source_url',
        'status',
        'confidence_score',
        'last_updated',
        'summary',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
