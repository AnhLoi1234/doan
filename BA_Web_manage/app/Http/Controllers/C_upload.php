<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class C_upload extends Controller
{
    public function upload(Request $request) {
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            return response()->json(['data'=>$filename]);
        }
    }
    public function delete(Request $request) {
        if (File::exists(public_path('images/' . $request->image))) {
            File::delete(public_path('images/' . $request->image));
        }
    }
}
