<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Venue;
use Image;
use File;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::with('event_type', 'venue', 'attendees')->orderBy('event_date', 'desc')->get();
        return view ('admin.events.index', compact('events'));
    }

    public function create()
    {
        $event_types = EventType::pluck('event_type', 'id');
        $venues = Venue::pluck('venue_name', 'id');
        return view ('admin.events.create', compact('venues', 'event_types'));
    }

    public function store(Event $event, Request $request)
    {
        $this->validate($request, [
            'venue_id' => 'required',
            'event_type_id' => 'required',
            'event_title' => 'required',
            'event_date' => 'required',
            'starts_at' => 'required',
            'stops_at' => 'required',
            'event_description' => 'required',
            'event_image_file' => 'required',
        ]);

        // Handle Event Image
        $image = request()->file('event_image_file');
        $ext = $image->guessClientExtension();
        $image_name = $event->slug . '_event_image.' . $ext;
        $image->storeAs('public/events', $image_name);
        $request['event_image'] = $image_name;

        // Handle Event Dates and Times
        $request['starts_at'] = $request['event_date'] . ' ' . $request['starts_at'] . ':00';
        $request['stops_at'] = $request['event_date'] . ' ' . $request['stops_at'] . ':00';
        $request['event_date'] = $request['event_date'] . ' 00:00:00';

        $event->create($request->all());

        return redirect()->route('admin.events.show', ['slug' => $event->slug]);
    }

    public function show(Event $event)
    {
        return view ('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $event_types = EventType::pluck('event_type', 'id');
        $venues = Venue::pluck('venue_name', 'id');
        return view ('admin.events.edit', compact('event', 'event_types', 'venues'));
    }

    public function update(Event $event, Request $request)
    {
        $this->validate($request, [
            'venue_id' => 'required',
            'event_type_id' => 'required',
            'event_title' => 'required',
            'event_date' => 'required',
            'starts_at' => 'required',
            'stops_at' => 'required',
            'event_description' => 'required'
        ]);

        // Handle Event Image
        if($request->file('event_image_file') != NULL )
        {
            // Set the storage path for event images
            $imagePath = storage_path('app/public/events');

            // On update, delete the previous photo to maintain good housekeeping
            File::delete($imagePath . '/' . $event->event_image);

            // Now handle the file upload, name, size, etc.
            $event_image_file = $request->file('event_image_file');
            $imageName = strtolower(str_random(20) . '.' . $event_image_file->getClientOriginalExtension());
            $event_image_file = Image::make($event_image_file->getRealPath())->resize(1200, 600);
            $event_image_file->save($imagePath . '/' . $imageName);
            $event_image_file->file_name = $imageName;
            $request['event_image'] = $imageName;
        }

        // Handle Event Dates and Times
        $request['starts_at'] = $request['event_date'] . ' ' . $request['starts_at'] . ':00';
        $request['stops_at'] = $request['event_date'] . ' ' . $request['stops_at'] . ':00';
        $request['event_date'] = $request['event_date'] . ' 00:00:00';

        $event->update($request->all());
        return redirect()->route('admin.events.show', ['slug' => $event->slug]);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index');
    }
}