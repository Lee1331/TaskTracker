<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_belongs_to_project()
    {
        $task = factory('App\Task')->create();
        $this->assertInstanceOf(Project::class, $task->project);
    }

    public function test_tasks_have_a_path()
    {
        $task = factory('App\Task')->create();
        $this->assertEquals("/projects/{$task->project->id}/tasks/{$task->id}", $task->path());
    }

    public function test_tasks_can_be_completed()
    {
        $task = factory('App\Task')->create();

        $this->assertFalse($task->completed);

        $task->complete();
        $this->assertTrue($task->fresh()->completed);
    }

    function test_it_can_be_marked_as_incomplete()
    {
        $task = factory('App\Task')->create(['completed' => true]);

        $this->assertTrue($task->completed);

        $task->incomplete();
        $this->assertFalse($task->fresh()->completed);
    }
}
