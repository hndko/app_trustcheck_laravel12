<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataCorrection extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'reporter_name',
        'reporter_email',
        'correction_details',
        'status',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
