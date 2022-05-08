<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class M_Admin extends Authenticatable
{
    use HasApiTokens,Notifiable;
    
    protected $guarded = [];  

    protected $hidden = [
        'password'
    ];
}
