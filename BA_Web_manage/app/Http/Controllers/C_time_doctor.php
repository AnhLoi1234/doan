<?php

namespace App\Http\Controllers;

use App\Models\M_time_doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\C_Admin;
use Illuminate\Support\Facades\DB;

class C_time_doctor extends Controller
{
    public function getAllTimeDoctor()
    {
        $result = DB::select("SELECT * FROM m_time_doctors");
        return response()->json(['data' => $result]);
    }

    public function getTimeDoctorByIdDoctor(Request $request)
    {
        $cAdmin = new C_Admin;
        $result = DB::select($cAdmin->stringQueryTimeDoctor . " AND m_time_doctors.idadmin = ? ", [$request->id]);
        return response()->json(['data' => $result]);
    }

    public function addTimeDoctor(Request $request)
    {
        $mTimeDoctor = new M_time_doctor;
        $mTimeDoctor->dayofweek = $request->dayofweek;
        $mTimeDoctor->idadmin = $request->idadmin;
        $mTimeDoctor->day = $request->day;
        $mTimeDoctor->month = $request->month;
        $mTimeDoctor->year = $request->year;
        $mTimeDoctor->name = $request->name;
        $mTimeDoctor->save();
        return response()->json(['data' => $mTimeDoctor]);
    }

    public function editTimeDoctor(Request $request)
    {
        DB::table('m_time_doctors')->where('id', $request->id)->update([
            'dayofweek' => $request->dayofweek,
            'day' => $request->day,
            'month' => $request->month,
            'year' => $request->year,
            'name' => $request->name
        ]);
        $result = DB::select("SELECT * FROM m_time_doctors WHERE id = ? ", [$request->id]);
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[0]]);
    }

    public function deleteTimeDoctor(Request $request)
    {
        $result = DB::delete('DELETE FROM m_time_doctors WHERE m_time_doctors.day = ? AND m_time_doctors.month = ? AND 
        m_time_doctors.year = ? ', [$request->day, $request->month, $request->year]);
        return response()->json(['data' => $result]);
    }
}
