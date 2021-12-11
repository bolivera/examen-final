<?php

namespace App\Model;

use Illuminate\Foundation\Auth\Usercliente as Authenticatable;

class Usercliente extends Authenticatable
{
    protected $primaryKey = 'id';
    protected $table = 'user_cliente';
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'provider',
    ];
}
