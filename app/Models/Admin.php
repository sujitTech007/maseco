<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'username', 'password', 'phone', 'country_code', 'country', 'state', 'profile_image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
