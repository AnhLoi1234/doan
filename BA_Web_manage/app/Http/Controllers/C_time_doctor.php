<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_time_doctor extends Controller
{
    public function getAllTimeDoctor()
    {
        $result = DB::select("SELECT * FROM m_time_doctors");
        return response()->json(['data' => $result]);
    }

    public function addTimeDoctor(Request $request)
    {
    }

    public function editTimeDoctor(Request $request)
    {
    }

    public function deleteTimeDoctor(Request $request)
    {
    }
}
