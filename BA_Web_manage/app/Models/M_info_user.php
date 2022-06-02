<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_info_user extends Model
{
    protected $fillable = [
        'address', 'position', 'description', 'avatar'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User\M_users');
    }

    public function specical()
    {
        return $this->hasOne('App\Models\M_info_user');
    }
}
