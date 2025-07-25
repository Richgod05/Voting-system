<?php

namespace App\Models;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPasswordTrait;

    // Your existing fillable, hidden, casts, etc.
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

     //relationship
    public function vote() {
        return $this->hasOne(Vote::class);
    }
}
