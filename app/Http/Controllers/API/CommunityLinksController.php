<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Request;
use DB;


class CommunityLinksController extends Controller
{
    public function setApproval(Request $request) {

        if(Request::ajax()) {
            $data = Request::all();

            DB::table('community_links')
                ->where('id', '=', $data['link_id'])
                ->update(array('approved' => $data['approved']));
        }
    }
}
