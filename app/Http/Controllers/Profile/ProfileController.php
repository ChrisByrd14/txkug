<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($slack_handle)
    {
        $member = User::with('role', 'attendance')->where('slack_handle', $slack_handle)->findOrFail(Auth::user()->id);
        return view ('profile.index', compact('member'));
    }


}
