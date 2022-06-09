<?php

namespace App\Http\Controllers;

use App\Models\M_reply_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_reply_user extends Controller
{
    public function addReplyUser(Request $request)
    {
        $mReplyUser = new M_reply_user;
        $mReplyUser->iduser = $request->iduser;
        $mReplyUser->content_reply = $request->content;
        $mReplyUser->idadmin = $request->idadmin;
        $mReplyUser->idbooklist = $request->idbooklist;
        $mReplyUser->is_reply = 1;
        $mReplyUser->save();
        $result = DB::select("SELECT * FROM m_reply_users INNER JOIN m_book_lists ON m_reply_users.idbooklist = m_book_lists.id 
        WHERE m_reply_users.iduser = ? AND m_reply_users.idadmin = ? AND m_reply_users.id ORDER BY m_reply_users.created_at DESC ", [
            $request->iduser,
            $request->idadmin,
            $mReplyUser->id
        ]);
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[0]]);
    }
    public function getReplyUser(Request $request)
    {
        $result = DB::select("SELECT * FROM m_reply_users INNER JOIN m_book_lists ON m_reply_users.idbooklist = m_book_lists.id 
        WHERE m_reply_users.idadmin = ? ORDER BY m_reply_users.created_at DESC ", [
            $request->id
        ]);
        return response()->json(['data' => $result]);
    }
    public function checkIsHaveReply(Request $request)
    {
        $bookLists = DB::select("SELECT * FROM m_book_lists WHERE m_book_lists.iddoctor = ? AND m_book_lists.iduser = ? 
        AND m_book_lists.status = 2", [$request->iddoctor, $request->iduser]);
        $replyUser = DB::select("SELECT * FROM m_reply_users WHERE m_reply_users.iduser = ? ", [$request->iduser]);
        $status = sizeof($bookLists) > 0 && sizeof($replyUser) === 0 ? true : false;
        return response()->json(['status' => $status]);
    }
}
