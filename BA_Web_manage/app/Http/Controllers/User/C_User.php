<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\user\Rq_resgister;
use App\Http\Requests\user\Rq_login;
use App\Models\User\M_users;
use App\Models\User\M_confirm;
use Illuminate\Support\Facades\DB;

// session_start();

class C_User extends Controller
{
    public function confirmEmail(Rq_resgister $request)
    {
        $Check = rand(1, 999999);
        $data = [
            'number' => $Check
        ];
        \Mail::to($request->email)->send(new \App\Mail\SendMail($data));
        M_confirm::whereNotNull('id')->delete();

        $confirm = new M_confirm;
        $confirm->email = $request->email;
        $confirm->code = $Check;
        $confirm->save();
        return true;
    }
    public function register(Rq_resgister $request)
    {
        $check = M_confirm::where('email', $request->email)->get();
        if ($request->code == $check[0]->code) {
            $user = new M_users;
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->save();
            return;
        } else {
            return response()->json(['message' => 'Mã xác nhận không chính xác!'], 401);
        }
    }
    public function login(Rq_login $request)
    {
        if (auth('user')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = M_users::where('email', '=', $request->email)->first();
            $user->token = $user->createToken('User', ['user'])->accessToken;
            return response()->json($user);
        } {
            return response()->json(['message' => 'Sai tên đăng nhập hoặc mật khẩu!'], 401);
        }
    }

    public function userAuth(Request $request)
    {
        return response()->json($request->user('api_user'));
    }

    public function getAllUser()
    {
        $result = DB::select("SELECT * FROM m_users");
        return (response()->json(['data' => $result]));
    }
}
