<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function loadChannels()
    {
        return view('admin.settings.channels.index');
    }

    public function loadEventTypes()
    {
        return view('admin.settings.event-types.index');
    }
}
