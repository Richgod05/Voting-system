<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPasswordTrait;

    // Optional: Laravel uses 'users' table by default, so you can omit this
    // protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // if you're using role-based logic
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship: one user has one vote
    public function vote()
    {
        return $this->hasOne(Vote::class, 'student_id'); // keep 'student_id' if that's your votes table column
    }
}