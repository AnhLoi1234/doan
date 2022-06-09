<?php

namespace App\Http\Controllers;

use App\Models\M_group_chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_group_chat extends Controller
{
    public function getAllGroupChat()
    {
        $result  = DB::select("SELECT * FROM m_group_chats");
        return response()->json(['data' => $result]);
    }

    public function addGroupChat(Request $request)
    {
        $mGroupChat = new M_group_chat;
        $mGroupChat->fullname = $request->fullname;
        $mGroupChat->phone = $request->phone;
        $mGroupChat->user = $request->user;
        $mGroupChat->save();
        return response()->json(['data' => $mGroupChat]);
    }

    public function getGroupChat(Request $request)
    {
        $result = DB::select(
            "SELECT DISTINCT m_chats.idgroupchat FROM m_chats WHERE m_chats.idadmin = ? GROUP BY m_chats.idgroupchat 
            ORDER BY m_chats.created_at DESC",
            [$request->idadmin]
        );
        $arrObj = [];
        foreach ($result as $key => $value) {
            $dt = DB::select("SELECT * FROM m_group_chats WHERE id = ? ", [$value->idgroupchat]);
            if (sizeof($dt) > 0) {
                $message = DB::select("SELECT * FROM m_chats WHERE m_chats.idgroupchat = $value->idgroupchat AND m_chats.type_chat != 0 ORDER BY m_chats.created_at DESC LIMIT 0,1 ");
                $isRead = DB::select("SELECT * FROM m_chats WHERE m_chats.idgroupchat = $value->idgroupchat AND m_chats.is_read = 0 AND m_chats.type_chat != 0");
                array_push($arrObj, [
                    'groupChat' => $dt[0],
                    'message' => sizeof($message) === 0 ? null : $message[0],
                    'lengthIsRead' => sizeof($isRead)
                ]);
            }
        }
        return response()->json(['data' => $arrObj]);
    }
}
