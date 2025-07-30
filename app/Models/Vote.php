<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    // Relationships

    // Update this to reference the new User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // still uses 'student_id' unless changed in DB
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}