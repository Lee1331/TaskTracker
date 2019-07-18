<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean'
    ];

    public function project(){
        return $this->belongsTo(Project::Class);
    }

      public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    /**
     * Boot the model.
     */
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::created(function ($task) {
    //         $task->project->recordActivity('created_task');
    //     });
    //     static::deleted(function ($task) {
    //         $task->project->recordActivity('deleted_task');
    //     });
    // }

    /**
     * Mark the task as complete.
     */
    public function complete()
    {
        $this->update(['completed' => true]);
        $this->project->recordActivity('completed_task');
    }

    /**
     * Mark the task as incomplete.
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->project->recordActivity('incompleted_task');

    }
}
