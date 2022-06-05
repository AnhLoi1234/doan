<?php

namespace App\Http\Controllers;

use App\Models\M_time_book;
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

    public function searchTimeBook(Request $request) {
        $result = DB::select("SELECT * FROM m_time_books WHERE time LIKE '%" . $request->value . "%'");
        return response()->json(['data'=>$result]);
    }

    public function getTimeBookById(Request $request)
    {
        $result = DB::select("SELECT * FROM m_time_books WHERE id = $request->id");
        return response()->json([
            'data' => sizeof($result) === 0 ? null : $result[0]
        ]);
    }

    public function addTimeBook(Request $request)
    {
        $mTimeBook = new M_time_book;
        $mTimeBook->time = $request->time;
        $mTimeBook->save();
        return response()->json([
            'data' => $mTimeBook
        ]);
    }

    public function updateTimeBook(Request $request)
    {
        DB::update("UPDATE m_time_books SET time = ? WHERE id = ? ", [$request->time, $request->id]);
        $mTimeBook = DB::select("SELECT * FROM m_time_books WHERE id = ?", [$request->id]);
        return response()->json([
            'data' => sizeof($mTimeBook)  === 0 ? null :  $mTimeBook[0]
        ]);
    }

    public function deleteTimeBook(Request $request)
    {
        DB::delete("DELETE FROM m_time_books WHERE id = $request->id");
        return response()->json([
            'status' => true
        ]);
    }
}
