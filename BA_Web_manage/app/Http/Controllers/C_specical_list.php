<?php

namespace App\Http\Controllers;

use App\Models\M_specical_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_specical_list extends Controller
{

    public function getSpecicalList()
    {
        $mSpecicalList = new M_specical_list;
        $mSpecicalList = $mSpecicalList->all();
        return response()->json([
            'data' => $mSpecicalList
        ]);
    }

    public function addSpecicalList(Request $request)
    {
        $mSpecicalList = new M_specical_list;
        $mSpecicalList->namespecical = $request->namespecical;
        $mSpecicalList->thumbnail = $request->thumbnail;
        $mSpecicalList->save();
        return response()->json([
            'data' => $mSpecicalList
        ]);
    }


    public function updateSpecicalList(Request $request)
    {
        DB::update("UPDATE m_specical_lists SET namespecical = '" . $request->namespecical . "' WHERE id = $request->id");
        $res = DB::select("SELECT * FROM m_specicallists WHERE id = $request->id");
        if (sizeof($res) === 0) {
            $res = new M_specical_list;
            $res->namespecical = $request->namespecical;
            $res->save();
            $res = [$res];
        }
        return response()->json([
            'data' => sizeof($res) >  0 ? $res[0] : null
        ]);
    }

    public function deleteSpecicalList(Request $request)
    {
        DB::delete("DELETE FROM m_specical_lists WHERE id = '" . $request->id . "'");
        return response()->json([
            'data' => $request->id
        ]);
    }
}
