<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $tasksCount = 0;
    protected $user;

    //calling this method will create a task, none exist by default on instantiation
    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function create()
    {
        $project = factory('App\Project')->create([
            'owner_id' => $this->user ?? factory('App\User'), //also works, preventing the need for... 'factory(User::class)->create()->id()'
        ]);

        factory('App\Task', $this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;

    }
}
