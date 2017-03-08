<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index($slack_handle)
    {
        $member = User::with('role', 'attendance')->where('slack_handle', $slack_handle)->findOrFail(Auth::user()->id);
//        dd($member);
//        $event = Event::with('venue')
//            ->where('stops_at', '>=', Carbon::now()->toDateTimeString())
//            ->orderBy('stops_at')
//            ->first();
//        $member = User::with('role', 'attendance')->orderBy('last_name')->find(Auth::id());
        return view ('profile.events', compact('member'));
    }

    
}
