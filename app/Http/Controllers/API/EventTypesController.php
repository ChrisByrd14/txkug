<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventType;

class EventTypesController extends Controller
{
    public function index()
    {
        return $eventTypes = EventType::orderBy('event_type')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'event_type' => 'required|unique:event_types',
        ]);

        return EventType::create($request->all());
    }

    public function show($id)
    {
        return EventType::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        return EventType::whereId($id)->update($request->all());
    }

    public function destroy($id)
    {
        return EventType::destroy($id);
    }
}
