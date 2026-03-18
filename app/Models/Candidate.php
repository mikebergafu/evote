<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    protected $fillable = [
        'election_id',
        'position_id',
        'name',
        'bio',
        'photo',
        'position',
    ];

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }

    public function electionPosition(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function voteCount(): int
    {
        return $this->votes()->count();
    }
}
