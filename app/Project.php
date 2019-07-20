<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activity;
use App\RecordsActivity;

class Project extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public function path(){
        // return '/projects/{$this->id}';
        return "/projects/{$this->id}";
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function members(){
        //is it true that a project can have many members?
        //is it true that a member can have many projects?
        //solution - pivot table
        return $this->belongsToMany(User::class, 'project_members')->withTimeStamps();
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function activity(){
        return $this->hasMany(Activity::class)->latest();
    }

    public function addTask($body){
        return $this->tasks()->create(compact('body'));
    }

    public function invite(User $user){
        return $this->members()->attach($user);
    }
}
