<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $guarded = [];

    public function path(){
        // return '/projects/{$this->id}';
        return "/projects/{$this->id}";
    }


    public function owner(){
        return $this->belongsTo(User::Class);
    }

    public function tasks(){
        return $this->hasMany(Task::Class);
    }

    public function addTask($body){
        return $this->tasks()->create(compact('body'));
    }
}
