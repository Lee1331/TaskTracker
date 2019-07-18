<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types. - treat 'changes' field as an array when we insert it into the db
     *
     * @var array
     */
    protected $casts = [
        'changes' => 'array'
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function project(){
        return $this->belongsTo(Project::Class);
    }
}
