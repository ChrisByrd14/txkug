<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DirectoryController extends Controller
{
    public function index()
    {
        $members = User::with('attendance')->orderBy('last_name')->paginate(20);
        return view('member.directory.index', compact('members'));
    }

    public function show($slug)
    {
        $member = User::with('attendance')->whereSlug($slug)->firstOrFail();
        return view('member.directory.show', compact('member'));
    }
}
