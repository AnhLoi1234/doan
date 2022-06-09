<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_address extends Controller
{
    public function getProvince()
    {
        $result = DB::select("SELECT * FROM province");
        return response()->json(['data' => $result]);
    }
    public function getDistrictByProvince(Request $request)
    {
        $result = DB::select("SELECT * FROM district WHERE _province_id = ? ", [$request->_province_id]);
        return response()->json(['data' => $result]);
    }
    public function getWardByDistrict(Request $request)
    {
        $result = DB::select("SELECT * FROM ward WHERE _district_id = ? ", [$request->_district_id]);
        return response()->json(['data' => $result]);
    }
}
