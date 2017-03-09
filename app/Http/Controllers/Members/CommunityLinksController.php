<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use Auth;
use App\Models\CommunityLink;
use App\Models\Channel;
use App\Queries\CommunityLinksQuery;
use Illuminate\Http\Request;
use Alert;


class CommunityLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel = null)
    {
        $links = (new CommunityLinksQuery)->get(
            request()->exists('popular'), $channel
        );

        $channels = Channel::orderBy('title', 'asc')->get();

        return view ('member.community-links.index', compact('links', 'channels', 'channel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id' => 'required',
            'title' => 'required',
            'link'  => 'required|active_url'
        ]);

        try
        {
            CommunityLink::from(auth()->user())->contribute($request->all());

            if (auth()->user()->hasRole('administrator')) {
                Alert::success('Your link has been posted!', 'Success!')
                    ->persistent('OK');
            } else {
                Alert::success('Thanks for posting a community link! It will be posted once it is approved.', 'Thanks!')
                    ->persistent('OK');
            }
        }
        catch(CommunityLinkAlreadySubmitted $e)
        {
            Alert::warning('Your link has already been submitted, but we\'ll bump the timestamps and bring that link back to the top!', 'Ok, so here\'s the deal ...')
                ->persistent('OK');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        //
    }
}
