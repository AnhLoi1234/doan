<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\admin\Rq_resgister;
use App\Http\Requests\admin\Rq_Admin_login;
use App\Models\Admin\M_Admin;
use App\Models\m_info_admin;
use Illuminate\Support\Facades\DB;
use App\Utils\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;

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
            // $result = DB::select("SELECT avatar from m_info_admins INNER JOIN m__admins ON m__admins.id = m_info_admins.idadmin 
            // WHERE m__admins.username = ? ", [$request->username]);
            // if (sizeof($result) > 0) {
            // }
            $Admin = M_Admin::Where('username', '=', $request->username)->first();
            // $Admin->avatar = $result[0]->avatar;
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
        $result = DB::select("SELECT * , m__admins.id as 'idadmin' FROM m__admins LEFT JOIN m_info_admins 
        ON m__admins.id = m_info_admins.idadmin INNER JOIN m_specical_lists ON m_specical_lists.id = m_info_admins.idspecicallist  
        WHERE m__admins.role != 0 ");
        $arrObj = [];
        $utils = new Utils;
        foreach ($result as $key => $value) {
            $books = DB::select("SELECT * FROM m_book_lists WHERE iddoctor = $value->idadmin AND datebook = CURDATE() AND dayofweek = " . ($utils->getWeekdayMain()));
            $dates = DB::select("SELECT * FROM `m_time_doctors` WHERE m_time_doctors.day >= DAY(NOW()) AND m_time_doctors.month >= 
            MONTH(NOW()) AND m_time_doctors.year >= YEAR(NOW()) AND m_time_doctors.idadmin = ? ", [$value->idadmin]);
            array_push($arrObj, ['info' => $value, 'books' => $books, 'dates' => $dates]);
        }
        return response()->json(['data' => $arrObj]);
    }
    public function getDoctorBySlug(Request $request)
    {
        $result = DB::select("SELECT * , m__admins.id as 'idadmin' FROM m__admins LEFT JOIN m_info_admins 
        ON m__admins.id = m_info_admins.idadmin INNER JOIN m_specical_lists ON m_specical_lists.id = m_info_admins.idspecicallist  
        WHERE m__admins.role != 0 AND m_specical_lists.slugspecical = ? ", [$request->slug]);
        $arrObj = [];
        $utils = new Utils;
        foreach ($result as $key => $value) {
            $books = DB::select("SELECT * FROM m_book_lists WHERE iddoctor = $value->idadmin AND datebook = CURDATE() AND dayofweek = " . ($utils->getWeekdayMain()));
            $dates = DB::select("SELECT * FROM `m_time_doctors` WHERE m_time_doctors.day >= DAY(NOW()) AND m_time_doctors.month >= 
            MONTH(NOW()) AND m_time_doctors.year >= YEAR(NOW()) AND m_time_doctors.idadmin = ? ", [$value->idadmin]);
            array_push($arrObj, ['info' => $value, 'books' => $books, 'dates' => $dates]);
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

    public function addDoctor(Request $request)
    {
        $mAdmin = new M_Admin;
        $mAdmin->name = $request->fullname;
        $mAdmin->username = $request->username;
        $mAdmin->password = Hash::make($request->password);
        $mAdmin->sdt = $request->phone;
        $mAdmin->role = $request->role;
        $mAdmin->save();

        $mInfoAdmin = new m_info_admin;
        $mInfoAdmin->idspecicallist = $request->idspecicallist;
        $mInfoAdmin->idadmin = $mAdmin->id;
        $mInfoAdmin->address = $request->address;
        $mInfoAdmin->position = $request->position;
        $mInfoAdmin->description_admin = $request->description;
        $mInfoAdmin->avatar = $request->avatar;
        $mInfoAdmin->save();

        $result = DB::select("SELECT * , m__admins.id as 'idadmin'  FROM m__admins LEFT JOIN m_info_admins ON m__admins.id = 
        m_info_admins.idadmin INNER JOIN m_specical_lists ON  m_info_admins.idspecicallist = m_specical_lists.id 
        WHERE m__admins.id = ? ", [$mAdmin->id]);
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[0]]);
    }

    public function getDoctorById(Request $request)
    {
        $result = DB::select("SELECT * , m__admins.id as 'idadmin' FROM m__admins LEFT JOIN m_info_admins 
        ON m__admins.id = m_info_admins.idadmin INNER JOIN m_specical_lists ON m_specical_lists.id = m_info_admins.idspecicallist  
        WHERE m__admins.id = ? ", [$request->id]);
        $arrObj = [];
        $utils = new Utils;
        foreach ($result as $key => $value) {
            $books = DB::select("SELECT * FROM m_book_lists WHERE iddoctor = $value->idadmin AND datebook = CURDATE() AND dayofweek = " . ($utils->getWeekdayMain()));
            $dates = DB::select("SELECT * FROM `m_time_doctors` WHERE m_time_doctors.day >= DAY(NOW()) AND m_time_doctors.month >= 
            MONTH(NOW()) AND m_time_doctors.year >= YEAR(NOW()) AND m_time_doctors.idadmin = ? ", [$value->idadmin]);
            array_push($arrObj, ['info' => $value, 'books' => $books, 'dates' => $dates]);
        }
        return response()->json(['data' => sizeof($arrObj) === 0 ? null : $arrObj[0]]);
    }

    public function deleteDoctor(Request $request)
    {
        $mDoctor = DB::select("SELECT * , m__admins.id as 'idadmin' FROM m__admins LEFT JOIN m_info_admins 
        ON m__admins.id = m_info_admins.idadmin INNER JOIN m_specical_lists ON m_specical_lists.id = m_info_admins.idspecicallist  
        WHERE m__admins.id = ? ", [$request->id]);
        if (sizeof($mDoctor) > 0) {
            if (File::exists(public_path('images/' . $mDoctor[0]->avatar))) {
                File::delete(public_path('images/' . $mDoctor[0]->avatar));
            }
        }
        DB::delete("DELETE FROM m__admins WHERE id = '" . $request->id . "'");
        return response()->json([
            'status' => true
        ]);
    }

    public function updateDoctor(Request $request)
    {
        $admin = DB::select("SELECT * FROM m__admins WHERE m__admins.id = ?", [$request->idadmin]);
        $admin = sizeof($admin) === 0 ? null : $admin[0];
        if ($admin) {
            $password = $request->updatePassword === 'true' ? Hash::make($request->password) : $admin->password;
            DB::table('m__admins')->where('m__admins.id', $request->idadmin)->update([
                'username' => $request->username,
                'name' => $request->fullname,
                'sdt' => $request->phone,
                'password' => $password
            ]);
            DB::table('m_info_admins')->where('m_info_admins.idadmin', $request->idadmin)->update([
                'position' => $request->position,
                'address' => $request->address,
                'idspecicallist' => $request->idspecicallist,
                'description_admin' => $request->description,
                'avatar' => $request->avatar
            ]);
            $result = DB::select("SELECT * , m__admins.id as 'idadmin'  FROM m__admins LEFT JOIN m_info_admins ON m__admins.id = 
        m_info_admins.idadmin INNER JOIN m_specical_lists ON  m_info_admins.idspecicallist = m_specical_lists.id 
        WHERE m__admins.id = ? ", [$request->idadmin]);
            return response()->json(['data' => sizeof($result) === 0 ? null : $result[0]]);
        }
    }

    public function searchAdmin(Request $request)
    {
        $result = DB::select("SELECT * , m__admins.id as 'idadmin'  FROM m__admins LEFT JOIN m_info_admins ON m__admins.id = 
        m_info_admins.idadmin INNER JOIN m_specical_lists ON  m_info_admins.idspecicallist = m_specical_lists.id 
        WHERE m__admins.role != 0 AND (m__admins.name LIKE '%" . $request->value . "%' OR 
        m__admins.sdt LIKE '%" . $request->value . "%') ");
        return response()->json(['data' => $result]);
    }

    public function randomDoctor()
    {
        $result = DB::select("SELECT * , m__admins.id as 'idadmin'  FROM m__admins LEFT JOIN m_info_admins ON m__admins.id = 
        m_info_admins.idadmin INNER JOIN m_specical_lists ON  m_info_admins.idspecicallist = m_specical_lists.id 
        WHERE m__admins.role != 0");
        $number = mt_rand(0, sizeof($result));
        return response()->json(['data' => sizeof($result) === 0 ? null : $result[$number - 1 < 0 ? 0 : $number - 1]]);
    }
}
