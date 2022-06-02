<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    public function getWeekday($date)
    {
        return date('w', strtotime($date));
    }

    public function getWeekdayMain()
    {
        return date('w', time());
    }
}
