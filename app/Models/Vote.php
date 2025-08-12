<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;
   protected $fillable = [
        'user_id',
        'candidate_id',
        'timestamp',
   ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // still uses 'student_id' unless changed in DB
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}