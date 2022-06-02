<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_book_list extends Model
{
    protected $fillable = [
        'datebook',
        'dayofweek',
        'iddoctor',
        'description',
        'status',
        'price',
        'fullname',
        'gender',
        'phone',
        'birthday',
        'address',
    ];
}
