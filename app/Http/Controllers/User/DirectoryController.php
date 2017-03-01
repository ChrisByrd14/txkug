<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DirectoryController extends Controller
{
    public function index()
    {
        $users = User::with('attendance')->orderBy('last_name')->paginate(20);
        return view('user.directory', compact('users'));
    }

    public function show($slug)
    {
        $user = User::with('attendance')->whereSlug($slug)->firstOrFail();
        return view('user.directory-show', compact('user'));
    }
}
