<?php

namespace App\Http\Controllers;

use App\Models\M_chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_chat extends Controller
{
    public function getChat(Request $request)
    {
        $result = DB::select("SELECT * , m_chats.created_at as 'created_at_main' FROM m_chats INNER JOIN m__admins ON m_chats.idadmin = m__admins.id
        WHERE m_chats.idgroupchat = ? AND m_chats.type_chat = 1 ORDER BY m_chats.created_at ASC", [$request->idgroupchat]);
        return response()->json(['data' => $result]);
    }

    public function getChatByIdAdmin(Request $request)
    {
        $result = DB::select(
            "SELECT * , m_chats.created_at as 'created_at_main'  FROM m_chats INNER JOIN m_group_chats ON m_chats.idgroupchat = m_group_chats.id 
            INNER JOIN m__admins ON m__admins.id = m_chats.idadmin WHERE m_chats.idadmin = ? ORDER BY m_chats.created_at ASC",
            [$request->idadmin]
        );
        return response()->json(['data' => $result]);
    }

    public function addChat(Request $request)
    {
        $mChat = new M_chat;
        $mChat->idgroupchat = $request->idgroupchat;
        $mChat->content_chat = $request->content_chat;
        $mChat->idadmin = $request->idadmin;
        $mChat->is_seen = 0;
        $mChat->is_read = 0;
        $mChat->is_user = $request->is_user;
        $mChat->type_chat = $request->type_chat;
        $mChat->save();
        return response()->json(['data' => $mChat]);
    }
}
