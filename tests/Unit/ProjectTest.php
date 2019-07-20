<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_projects_have_a_path()
    {
        $project = factory('App\Project')->create();
        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    // public function test_projects_belong_to_an_owner()
    // {
    //     // $this->signIn();
    //     $project = factory('App\Project')->create();
    //     $this->assertInstanceOf('App\User', $project->owner());
    // }

    public function test_projects_can_add_new_tasks()
    {
        $project = factory('App\Project')->create();
        $task = $project->addTask('test task');

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }

    public function test_projects_can_invite_new_users()
    {
        $project = factory('App\Project')->create();

        $project->invite($user = factory('App\User')->create());

        $this->assertTrue($project->members->contains($user));
    }
}
