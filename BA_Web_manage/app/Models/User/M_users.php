<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class M_users extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'fullname', 'gender', 'phone', 'email', 'password', 'type_user'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
