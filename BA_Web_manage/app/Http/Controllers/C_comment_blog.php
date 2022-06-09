<?php

namespace App\Http\Controllers;

use App\Models\M_comment_blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_comment_blog extends Controller
{
    public function addCommentBlog(Request $request)
    {
        $mCommentBlog = new M_comment_blog;
        $mCommentBlog->fullname =  $request->fullname;
        $mCommentBlog->content_comment = $request->content;
        $mCommentBlog->idblog = $request->idblog;
        $mCommentBlog->iduser = $request->iduser;
        $mCommentBlog->save();
        return response()->json(['data' => $mCommentBlog]);
    }
    public function getCommentBlogBySlug(Request $request)
    {
        $result = DB::select("SELECT * FROM m_blogs INNER JOIN m_comment_blogs ON m_blogs.id = m_comment_blogs.idblog 
        WHERE m_blogs.slug_blog = ? ", [$request->slug]);
        return response()->json(['data' => $result]);
    }
}
