<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\admin\Rq_resgister;
use App\Http\Requests\admin\Rq_Admin_login;
use App\Models\Admin\M_Admin;

class C_Admin extends Controller
{
    public function register(Rq_resgister $request){
        $admin = new M_Admin;
        $admin -> fill($request->all());
        $admin->password = Hash::make($request->password);

        $admin->save();

        return response()->json($admin);
    }

    public function login(Rq_Admin_login $request){
        if(auth('admin')->attempt([
        'username' => $request->username,
        'password' => $request->password]))
        {
           $Admin = M_Admin::Where('username','=',$request -> username)->first();
           $Admin->token = $Admin->createToken('Admin',['admin'])->accessToken;
           return response()->json($Admin);
        }
        {
           return response()->json(['message'=>'Sai tên đăng nhập hoặc mật khẩu!'],401);
        }
    }

    public function adminAuth(Request $request){
        return response()->json($request->user('api_admin'));
    }
}
