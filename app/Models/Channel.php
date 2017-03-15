<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\Sluggable;

class Channel extends Model {

    use SoftDeletes, Sluggable, SluggableScopeHelpers;

    protected $table = 'channels';

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
        'title',
        'color'
    ];

}
