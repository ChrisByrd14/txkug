<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;

class ChannelsController extends Controller
{
    public function index()
    {
        return $channelsList = Channel::orderBy('title')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:channels',
        ]);

        return Channel::create($request->all());
    }

    public function show($id)
    {
        return Channel::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        return Channel::whereId($id)->update($request->all());
    }

    public function destroy($id)
    {
        return Channel::destroy($id);
    }

    public function restore($id)
    {
        return Channel::withId($id)->restore();
    }
}
