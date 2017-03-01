<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable, Sluggable, SluggableScopeHelpers;

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

    public function routeNotificationForSlack()
    {
        return env('SLACK_WEBHOOK_URL');
    }

    public function getNameAttribute($value)
    {
        $name = $value.$this->first_name. ' ' . $value.$this->last_name;
        return $name;
    }
}
