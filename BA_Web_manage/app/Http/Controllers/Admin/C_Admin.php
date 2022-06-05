<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\admin\Rq_resgister;
use App\Http\Requests\admin\Rq_Admin_login;
use App\Models\Admin\M_Admin;
use Illuminate\Support\Facades\DB;
use App\Utils\Utils;

class C_Admin extends Controller
{
    public function register(Rq_resgister $request)
    {
        $admin = new M_Admin;
        $admin->fill($request->all());
        $admin->password = Hash::make($request->password);

        $admin->save();

        return response()->json($admin);
    }

    public function login(Rq_Admin_login $request)
    {
        if (auth('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            $Admin = M_Admin::Where('username', '=', $request->username)->first();
            $Admin->token = $Admin->createToken('Admin', ['admin'])->accessToken;
            return response()->json($Admin);
        } {
            return response()->json(['message' => 'Sai tên đăng nhập hoặc mật khẩu!'], 401);
        }
    }

    public function adminAuth(Request $request)
    {
        return response()->json($request->user('api_admin'));
    }

    public function getDoctor()
    {
        $result = DB::select("SELECT * , m__admins.id as 'idadmin'  FROM m__admins LEFT JOIN m_info_admins ON m__admins.id = m_info_admins.idadmin WHERE m__admins.role != 0");
        $arrObj = [];
        $utils = new Utils;
        foreach ($result as $key => $value) {
            $books = DB::select("SELECT * FROM m_book_lists WHERE iddoctor = $value->idadmin AND datebook = CURDATE() AND dayofweek = " . ($utils->getWeekdayMain()));
            $dates = DB::select("SELECT * FROM m_time_doctors WHERE idadmin = $value->idadmin");
            array_push($arrObj, ['info' => $value, 'books' => $books,'dates'=>$dates]);
        }
        return response()->json(['data' => $arrObj]);
    }
    public function getDoctorAdmin()
    {
        $result = DB::select("SELECT * , m__admins.id as 'idadmin'  FROM m__admins LEFT JOIN m_info_admins ON m__admins.id = 
        m_info_admins.idadmin INNER JOIN m_specical_lists ON  m_info_admins.idspecicallist = m_specical_lists.id 
        WHERE m__admins.role != 0");
        return response()->json(['data' => $result]);
    }
}
