<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DirectoryController extends Controller
{
    public function index()
    {
        $users = User::with('attendance')->orderBy('last_name')->get();
        return view('user.directory', compact('users'));
    }
}
