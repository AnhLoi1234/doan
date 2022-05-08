<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\Rq_Admin_login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\M_Admin;


class C_Admin_login extends Controller
{
    public function login(Rq_Admin_login $request){
        if(auth('api')->attempt([
        'username' => $request->username,
        'password' => $request->password]))
        {
           $Admin = M_Admin::Where('username','=',$request -> username)->first();
           $Admin->token = $Admin->createToken("token")->accessToken;
           return response()->json($Admin);
        }
        {
           return response()->json(['message'=>'sai tên đăng nhập hoặc mật khẩu'],401);
        }
    }
}
