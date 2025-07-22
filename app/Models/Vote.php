<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //relationship
    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function candidate() {
        return $this->belongsTo(Candidate::class);
    }
}
