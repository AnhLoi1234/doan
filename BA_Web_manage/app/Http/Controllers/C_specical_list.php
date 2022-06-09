<?php

namespace App\Http\Controllers;

use App\Models\M_specical_list;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

    public function searchSpecicalList(Request $request)
    {
        $result = DB::select("SELECT * FROM m_specical_lists WHERE namespecical LIKE '%" . $request->value . "%'");
        return response()->json(['data' => $result]);
    }

    public function getSpecicalListBySlug(Request $request)
    {
        $mSpecicalList = DB::select("SELECT * FROM m_specical_lists WHERE slugspecical = ?", [$request->slug]);
        return response()->json([
            'data' => sizeof($mSpecicalList) === 0 ? null : $mSpecicalList[0]
        ]);
    }

    public function getSpecicalListById(Request $request)
    {
        $mSpecicalList = DB::select("SELECT * FROM m_specical_lists WHERE id = ?", [$request->id]);
        return response()->json([
            'data' => sizeof($mSpecicalList) === 0 ? null : $mSpecicalList[0]
        ]);
    }

    public function addSpecicalList(Request $request)
    {
        $mSpecicalList = new M_specical_list;
        $mSpecicalList->namespecical = $request->namespecical;
        $mSpecicalList->thumbnail = $request->thumbnail;
        $mSpecicalList->description_specical = $request->description;
        $mSpecicalList->slugspecical = (new Utils)->createSlug($request->namespecical);
        $mSpecicalList->save();
        return response()->json([
            'data' => $mSpecicalList
        ]);
    }


    public function updateSpecicalList(Request $request)
    {
        DB::table('m_specical_lists')->where('id', $request->id)->update([
            'namespecical' => $request->namespecical,
            'thumbnail' => $request->thumbnail,
            'description_specical' => $request->description,
            'slugspecical' => (new Utils)->createSlug($request->namespecical)
        ]);
        $res = DB::select("SELECT * FROM m_specical_lists WHERE id = ? ", [$request->id]);
        // if (sizeof($res) === 0) {
        //     $res = new M_specical_list;
        //     $res->namespecical = $request->namespecical;
        //     $res->thumbnail = $request->thumbnail;
        //     $res->save();
        //     $res = [$res];
        // }
        return response()->json([
            'data' => sizeof($res) >  0 ? $res[0] : null
        ]);
    }

    public function deleteSpecicalList(Request $request)
    {
        $mSpecicalList = DB::select("SELECT * FROM m_specical_lists WHERE id = ?", [$request->id]);
        if (sizeof($mSpecicalList) > 0) {
            if (File::exists(public_path('images/' . $mSpecicalList[0]->thumbnail))) {
                File::delete(public_path('images/' . $mSpecicalList[0]->thumbnail));
            }
        }
        DB::delete("DELETE FROM m_specical_lists WHERE id = '" . $request->id . "'");
        return response()->json([
            'status' => true
        ]);
    }
}
