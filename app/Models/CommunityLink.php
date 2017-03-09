<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;

class CommunityLink extends Model {

    use SoftDeletes, Sluggable, SluggableScopeHelpers;

    protected $table = 'community_links';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }

    protected $fillable = [
        'channel_id',
        'title',
        'link'
    ];

    public static function from(User $user)
    {
        $link = new static;
        $link->user_id = $user->id;
        if (auth()->user()->hasRole('administrator')){
            $link->approve();
        }
        return $link;
    }

    public function contribute($attributes)
    {
        if ($existing = $this->hasAlreadyBeenSubmitted($attributes['link']))
        {
            $existing->touch();
            throw new CommunityLinkAlreadySubmitted;
        }
        return $this->fill($attributes)->save();
    }

    public function scopeForChannel($builder, $channel)
    {
        if($channel->exists)
        {
            return $builder->where('channel_id', $channel->id);
        }
        return $builder;
    }

    public function approve(){
        $this->approved = true;
        return $this;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function votes()
    {
        return $this->hasMany(CommunityLinksVote::class, 'community_link_id');
    }

    protected function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();
    }





}
