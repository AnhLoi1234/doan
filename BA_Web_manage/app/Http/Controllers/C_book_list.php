<?php

namespace App\Http\Controllers;

use App\Models\M_book_list;
use Illuminate\Http\Request;
use App\Utils\Utils;
use Illuminate\Support\Facades\DB;

class C_book_list extends Controller
{
    public function addBookList(Request $request)
    {
        $utils = new Utils;
        $mBookList = new M_book_list;
        $mBookList->datebook = date('Y/m/d');
        $mBookList->iddoctor = $request->iddoctor;
        $mBookList->description = $request->description;
        $mBookList->idtimebook = $request->idtimebook;
        $mBookList->dayofweek = $utils->getWeekdayMain();
        $mBookList->iduser = $request->iduser;
        $mBookList->fullname = $request->fullname;
        $mBookList->gender = $request->gender;
        $mBookList->phone = $request->phone;
        $mBookList->birthday = $request->birthday;
        $mBookList->address = $request->address;
        $mBookList->save();

        return response()->json(['data' => $mBookList]);
    }

    public function updateStatusBook(Request $request)
    {
        DB::update('UPDATE m_book_lists SET status = ? WHERE id = ?', [$request->status, $request->id]);
        return response()->json(['status' => true]);
    }

    public function deleteBookList(Request $request)
    {
        DB::delete('DELETE FROM m_book_lists WHERE id = ? ', [$request->id]);
        return response()->json(['status' => true]);
    }
}
