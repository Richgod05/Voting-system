<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        // add any other columns you want to mass-assign:
        // 'level',
        // 'programme',
        // 'manifesto',
        // 'status',
        // 'image',
    ];

    /**
     * Relationships
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}