<?php

namespace App\Http\Controllers;

use App\Models\M_book_list;
use Illuminate\Http\Request;
use App\Utils\Utils;
use Illuminate\Support\Facades\DB;

class C_book_list extends Controller
{

    public $queryDefault = "SELECT * , m_book_lists.fullname as 'fullname_main' , m_book_lists.phone 
    as 'phone_main', m_book_lists.email as 'email_main' , m_book_lists.created_at as 'created_at_main' ,
    m__admins.name as 'name_doctor' , m_info_admins.avatar as 'avatar_doctor' , m_book_lists.gender as 'gender_main' ,
    m_users.avatar as 'avatar_user' , m_book_lists.address as 'address_main' , m_book_lists.id as 'idbooklist_main',
    m_book_lists.status as 'status_book_list' FROM m_book_lists INNER JOIN m__admins 
    ON m_book_lists.iddoctor = m__admins.id INNER JOIN m_info_admins ON 
    m_info_admins.idadmin = m__admins.id INNER JOIN m_specical_lists ON 
    m_specical_lists.id = m_info_admins.idspecicallist INNER JOIN m_time_books ON 
    m_book_lists.idtimebook = m_time_books.id INNER JOIN m_time_doctors ON 
    m_book_lists.idtimedoctor = m_time_doctors.id INNER JOIN m_users ON m_users.id = m_book_lists.iduser";

    public function getAllBookList()
    {
        $result = DB::select($this->queryDefault);
        return response()->json(['data' => $result]);
    }

    public function searchBookList(Request $request)
    {
        $result = DB::select($this->queryDefault . " WHERE (m_users.fullname LIKE '%" . $request->value . "%' OR m__admins.name LIKE " .
            "'%" . $request->value . "%' OR m_book_lists.phone LIKE " . "'%" . $request->value . "%' OR m_book_lists.email LIKE " .
            "'%" . $request->value . "%') " . ($request->status ? "AND m_book_lists.status = " . $request->status : ''));
        return response()->json(['data' => $result]);
    }

    public function getBookListLimit()
    {
        $result = DB::select($this->queryDefault . " ORDER BY m_book_lists.created_at DESC LIMIT 0,10 ");
        return response()->json(['data' => $result]);
    }

    public function getBookListById(Request $request)
    {
        $result = DB::select("SELECT * FROM m_book_lists INNER JOIN m__admins ON m_book_lists.iddoctor = m__admins.id 
        INNER JOIN  m_users ON  m_book_lists.iduser = m_users.id WHERE m_book_lists.id = ? ", [$request->id]);
        return response()->json(['data' => $result]);
    }

    public function getBookListByIdUser(Request $request)
    {
        $result = DB::select($this->queryDefault . " WHERE m_users.id = ? ", [$request->iduser]);
        return response()->json(['data' => $result]);
    }

    public function getBookListByIdDoctor(Request $request)
    {
        $result = DB::select($this->queryDefault . " WHERE m__admins.id = ? ", [$request->iddoctor]);
        return response()->json(['data' => $result]);
    }

    public function addBookList(Request $request)
    {
        $utils = new Utils;
        $mBookList = new M_book_list;
        $mBookList->datebook = date('Y/m/d');
        $mBookList->iddoctor = $request->iddoctor;
        $mBookList->idtimedoctor = $request->idtimedoctor;
        $mBookList->description = $request->description;
        $mBookList->idtimebook = $request->idtimebook;
        $mBookList->dayofweek = $utils->getWeekdayMain();
        $mBookList->iduser = $request->iduser;
        $mBookList->price = 0;
        $mBookList->fullname = $request->fullname;
        $mBookList->gender = $request->gender;
        $mBookList->phone = $request->phone;
        $mBookList->email = $request->email;
        $mBookList->birthday = date('Y/m/d');
        $mBookList->address = $request->address;
        $mBookList->status = 0;
        $mBookList->description = $request->description;
        $mBookList->type_booklist = $request->typeBookList;
        $mBookList->save();

        return response()->json(['data' => $mBookList]);
    }

    public function updateStatusBook(Request $request)
    {
        DB::update('UPDATE m_book_lists SET status = ? WHERE id = ?', [$request->status, $request->id]);
        $result = DB::select($this->queryDefault . " WHERE m_book_lists.id = ? ", [$request->id]);
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[0], 'status' => true]);
    }

    public function deleteBookList(Request $request)
    {
        DB::delete('DELETE FROM m_book_lists WHERE id = ? ', [$request->id]);
        return response()->json(['status' => true]);
    }

    public function updateStatus(Request $request)
    {
        DB::update('UPDATE m_book_lists SET status = ? WHERE id = ?', [$request->status, $request->id]);

        //
        $result = DB::select($this->queryDefault . " WHERE m_book_lists.id = ? ", [$request->id]);
        $result = sizeof($result) === 0 ? null : $result[0];
        if ($result) {
            if ($result->status_book_list == 1) {
                \Mail::to($result->email_main)->send(new \App\Mail\SendMail($result, 'Notify'));
            }
            if ($result->status_book_list == -1) {
                \Mail::to($result->email_main)->send(new \App\Mail\SendMail($result, 'Cancel'));
            }
            return response()->json(['data' => $result, 'status' => true]);
        }
    }
}
