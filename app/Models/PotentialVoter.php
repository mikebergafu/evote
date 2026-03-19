<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PotentialVoter extends Model
{
    protected $fillable = [
        'election_id',
        'title',
        'full_name',
        'email',
        'mobile',
    ];

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }
}
