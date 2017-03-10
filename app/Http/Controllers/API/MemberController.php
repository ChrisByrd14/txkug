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

            DB::table('users')
                ->where('id', '=', $data['user_id'])
                ->update(array('role_id' => $data['role_id']));
        }
    }
}
