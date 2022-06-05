<?php

namespace App\Http\Controllers;

use App\Models\M_book_list;
use Illuminate\Http\Request;
use App\Utils\Utils;
use Illuminate\Support\Facades\DB;

class C_book_list extends Controller
{

    public function getAllBookList()
    {
        $result = DB::select("SELECT * FROM m_book_lists INNER JOIN m__admins ON m_book_lists.iddoctor = m__admins.id 
        INNER JOIN  m_users ON  m_book_lists.iduser = m_users.id");
        return response()->json(['data' => $result]);
    }

    public function getBookListLimit()
    {
        $result = DB::select("SELECT * FROM m_book_lists INNER JOIN m__admins ON m_book_lists.iddoctor = m__admins.id 
        INNER JOIN  m_users ON  m_book_lists.iduser = m_users.id ORDER BY m_book_lists.created_at DESC LIMIT 0,10 ");
        return response()->json(['data' => $result]);
    }

    public function getBookListById(Request $request)
    {
        $result = DB::select("SELECT * FROM m_book_lists INNER JOIN m__admins ON m_book_lists.iddoctor = m__admins.id 
        INNER JOIN  m_users ON  m_book_lists.iduser = m_users.id WHERE m_book_lists.id = ? ", [$request->id]);
        return response()->json(['data' => $result]);
    }

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
