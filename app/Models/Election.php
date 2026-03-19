<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Election extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'starts_at',
        'ends_at',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class)->orderBy('position');
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class)->orderBy('order');
    }

    public function voters(): HasMany
    {
        return $this->hasMany(Voter::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' 
            && now()->between($this->starts_at, $this->ends_at);
    }

    public function hasEnded(): bool
    {
        return now()->isAfter($this->ends_at);
    }
}
