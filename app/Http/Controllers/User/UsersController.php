<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function home() {
        $user = User::with('role', 'attendance')->findOrFail(Auth::id());
        return view('user.home', compact('user'));
    }

    public function events() {
        $event = Event::with('venue')
            ->where('stops_at', '>=', Carbon::now()->toDateTimeString())
            ->orderBy('stops_at')
            ->first();
        $user = User::with('role', 'attendance')->orderBy('last_name')->find(Auth::id());
        return view ('user.events', compact('user', 'event'));
    }
}
