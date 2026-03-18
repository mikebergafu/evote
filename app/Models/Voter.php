<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voter extends Model
{
    protected $fillable = [
        'election_id',
        'voter_id',
        'name',
        'phone',
        'device_fingerprint',
        'device_registered',
        'has_voted',
        'voted_at',
    ];

    protected $casts = [
        'device_registered' => 'boolean',
        'has_voted' => 'boolean',
        'voted_at' => 'datetime',
    ];

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }
}
