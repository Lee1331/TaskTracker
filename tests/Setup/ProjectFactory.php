<?php

namespace Tests\Setup;

use App\User;
use App\Project;
use App\Task;

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
        $project = factory(Project::class)->create([
            'owner_id' => $this->user ?? factory(User::class), //also works, preventing the need for... 'factory(User::class)->create()->id()'
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
