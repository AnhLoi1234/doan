<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_info_admin extends Model
{
    protected $fillable = [
        'address', 'position', 'description', 'avatar'
    ];
}
