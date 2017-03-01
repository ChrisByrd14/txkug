<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $nextEvent = Event::with('venue')
            ->where('stops_at', '>=', Carbon::now()->toDateTimeString())
            ->orderBy('stops_at')
            ->first();

        return view('welcome', compact('nextEvent'));
    }
}