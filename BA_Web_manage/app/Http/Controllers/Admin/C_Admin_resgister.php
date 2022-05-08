<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\M_Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class C_Admin_resgister extends Controller
{
    public function register(Request $request){
        $admin = new M_Admin;
        $admin -> fill($request->all());
        $admin->password = Hash::make($request->password);

        $admin->save();

        return response()->json($admin);
    }
}
