<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class M_confirm extends Model
{
    protected $fillable = [
        'email','code'
    ];
}
