<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'website',
        'industry',
        'head_office',
        'email',
        'phone',
        'founded_year',
        'employees_count',
        'trust_score',
        'risk_level',
        'ai_summary',
        'status',
    ];

    public function metric(): HasOne
    {
        return $this->hasOne(CompanyMetric::class, 'company_id');
    }

    public function sources(): HasMany
    {
        return $this->hasMany(CompanySource::class, 'company_id');
    }

    public function news(): HasMany
    {
        return $this->hasMany(CompanyNews::class, 'company_id')->orderBy('id', 'desc');
    }
}
