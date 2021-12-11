<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use Notifiable;
    protected $guard = 'administrator';
    protected $table = 'users';
    protected $fillable = [
        'name', 'email ', 'password',
    ];
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
