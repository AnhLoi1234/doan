<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_time_doctor extends Model
{
    protected $fillable = [
        'dayofweek',
        'day',
        'month',
        'name'
    ];
}
