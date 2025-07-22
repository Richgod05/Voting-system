<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //relationship
    public function vote() {
        return $this->hasOne(Vote::class);
    }
}
