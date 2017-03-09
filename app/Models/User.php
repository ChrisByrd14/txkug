<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentTaggable\Taggable;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable, Sluggable, SluggableScopeHelpers, Taggable;

    protected $table = 'users';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['first_name', 'last_name']
            ]
        ];
    }

    protected $guarded = ['id'];

    protected $hidden = ['password', 'remember_token'];

    public function routeNotificationForSlack()
    {
        return env('SLACK_WEBHOOK_URL');
    }

    public function getNameAttribute($value)
    {
        $name = $value.$this->first_name. ' ' . $value.$this->last_name;
        return $name;
    }

    // Each User can attend many events
    public function attendance() {
        return $this->hasMany(
            Attendee::class, 'user_id'
        );
    }

    // Each User is assigned a role
    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasRole($name)
    {
        if($this->role->name == $name) return true;
        return false;
    }

    public function votes()
    {
        $this->belongsToMany(CommunityLink::class, 'community_links_votes')
            ->withTimestamps();
    }

    public function toggleVoteFor(CommunityLink $link)
    {
        CommunityLinksVote::firstOrNew([
            'user_id' => auth()->user()->id,
            'community_link_id' => $link->id,
        ])->toggle();
    }

    public function votedFor(CommunityLink $link)
    {
        return $link->votes->contains('user_id', $this->id );
    }
}
