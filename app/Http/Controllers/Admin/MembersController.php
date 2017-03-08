<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use SlackApi;

class MembersController extends Controller
{
    public function index() {

        $members = User::with('attendance')->orderBy('last_name')->get();

        return view ('admin.members.index', compact('members'));

    }

    public function show($slug) {

        $member = User::with('attendance')->whereSlug($slug)->firstOrFail();

        return view ('admin.members.show', compact('member', 'avatar'));

    }
}
