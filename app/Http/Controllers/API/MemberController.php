<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Request;
use DB;

class MemberController extends Controller
{
    public function setRole(Request $request) {

        if(Request::ajax()) {
            $data = Request::all();

            $role = DB::table('roles')->where('name', '=', $data['role_name'])->first();

            DB::table('users')
                ->where('id', '=', $data['id'])
                ->update(array('role_id' => $role->id));
        }
    }
}
