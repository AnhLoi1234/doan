<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_blog extends Model
{
    protected $fillable = [
        'title', 'thumbnail', 'content',
    ];
}
