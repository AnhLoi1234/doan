<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\Rq_Admin_login;

class C_Admin_login extends Controller
{
    public function Admin_login(Rq_Admin_login $request){
        if(auth('admin')->attempt([
            'username'=>$request->username,
            'password'=>$request->password]))
        {
            
        }
        {
            return view('Admin/Admin_login');
        }
    }
}
