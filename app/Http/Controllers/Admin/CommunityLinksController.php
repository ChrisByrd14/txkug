<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommunityLink;

class CommunityLinksController extends Controller
{
    public function index()
    {
        $links = CommunityLink::with('creator', 'channel')->get();
        return view('admin.community-links.index', compact('links'));
    }
}
