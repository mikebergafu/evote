<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotentialVoter extends Model
{
    protected $fillable = [
        'title',
        'full_name',
        'email',
        'mobile',
    ];
}
