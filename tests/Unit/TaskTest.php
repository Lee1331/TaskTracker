<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_task_belongs_to_project()
    // {
    //     $task = factory('App\Task')->create();
    //     $this->assertInstanceOf(Project::class(), $task->project);
    // }

    // public function test_tasks_have_a_path()
    // {
    //     $task = factory('App\Task')->create();
    //     $this->assertEquals('/projects/' . $project->path() . '/tasks/' . $task->id, $task->path());
    // }
}
