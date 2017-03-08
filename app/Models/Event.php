<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentTaggable\Taggable;

class Event extends Model
{
    use SoftDeletes, FormAccessible, Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = 'events';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'event_title'
            ]
        ];
    }

    public function getEventSlugAttribute()
    {
        return $this->event_title;
    }

    protected $dates = [
        'event_date',
        'starts_at',
        'stops_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'venue_id',
        'event_type_id',
        'event_title',
        'event_description',
        'event_image',
        'event_date',
        'starts_at',
        'stops_at'
    ];

    // Each Event belongs to one Venue
    public function venue() {
        return $this->belongsTo(
            Venue::class, 'venue_id'
        );
    }

    // Each Event belongs to one Event Type
    public function event_type() {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    // Each event can have many attendees
    public function attendees() {
        return $this->hasMany(Attendee::class,'event_id');
    }

    public function formEventDateAttribute($date) {
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function formStartsAtAttribute($value) {
        return Carbon::parse($value)->format('H:i');
    }

    public function formStopsAtAttribute($value) {
        return Carbon::parse($value)->format('H:i');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($event)
        {
            $event->attendees()->delete();
        });
    }
}