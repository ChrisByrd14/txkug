<?php

namespace App\Http\Controllers\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommunityLink;

class CommunityLinksVotesController extends Controller
{
    public function store(CommunityLink $link)
    {
        auth()->user()->toggleVoteFor($link);

        return back();
    }

}
