<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_time_book extends Controller
{
    public function getAllTimeBook()
    {
        $result = DB::select('SELECT * FROM m_time_books');
        return response()->json([
            'data' => $result
        ]);
    }
}
