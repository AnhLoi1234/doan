<?php

namespace App\Http\Controllers;

use App\Models\M_blog;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class C_blog extends Controller
{

    public function getBlog()
    {
        $result = DB::select("SELECT * FROM m_blogs");
        return response()->json(['data' => $result]);
    }

    public function getBlogBySlug(Request $request)
    {
        $result = DB::select("SELECT * FROM m_blogs WHERE slug_blog = ? ", [$request->slug]);
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[0]]);
    }

    public function getBlogDifferentSlug(Request $request)
    {
        $result = DB::select("SELECT * FROM m_blogs WHERE slug_blog != ? ", [$request->slug]);
        return response()->json(['data' => $result]);
    }

    public function getBlogByType(Request $request)
    {
        $result = DB::select("SELECT * FROM m_blogs WHERE type_blog = ? ", [$request->type]);
        return response()->json(['data' => $result]);
    }

    public function searchBlog(Request $request)
    {
        $result = DB::select("SELECT * FROM m_blogs WHERE title LIKE '%" . $request->value . "%' ");
        return response()->json(['data' => $result]);
    }

    public function getBlogById(Request $request)
    {
        $result = DB::select("SELECT * FROM m_blogs WHERE id = ? ", [$request->id]);
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[0]]);
    }

    public function addBlog(Request $request)
    {
        $mBlog = new M_blog;
        $mBlog->thumbnail = $request->thumbnail;
        $mBlog->title = $request->title;
        $mBlog->slug_blog = (new Utils)->createSlug($request->title);
        $mBlog->content = $request->content;
        $mBlog->view = 0;
        $mBlog->type_blog = $request->typeBlog;
        $mBlog->save();
        return response()->json(['data' => $mBlog]);
    }

    public function updateViewBlog(Request $request)
    {
        DB::update('UPDATE m_blogs SET view = view + 1 WHERE slug_blog = ? ', [$request->slug]);
    }

    public function editBlog(Request $request)
    {
        DB::table('m_blogs')->where('id', $request->id)->update([
            'thumbnail' => $request->thumbnail,
            'content' => $request->content,
            'title' => $request->title,
            'type_blog' => $request->typeBlog,
            'slug_blog' => (new Utils)->createSlug($request->title)
        ]);
        $result = DB::select("SELECT * FROm m_blogs WHERE id = ? ", [$request->id]);
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[0]]);
    }

    public function deleteBlog(Request $request)
    {
        $mBlog = DB::select("SELECT * FROM m_blogs WHERE id = ?", [$request->id]);
        if (sizeof($mBlog) > 0) {
            if (File::exists(public_path('images/' . $mBlog[0]->thumbnail))) {
                File::delete(public_path('images/' . $mBlog[0]->thumbnail));
            }
        }
        $result = DB::delete("DELETE FROM m_blogs WHERE id = ? ", [$request->id]);
        return response()->json(['status' => $result]);
    }
}
