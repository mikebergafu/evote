<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Election extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($election) {
            $election->uuid = Str::uuid();
        });
    }

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
