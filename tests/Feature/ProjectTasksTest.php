<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_guests_cannot_add_tasks_to_projects()
    {
        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    // public function test_project_owners_can_update_existing_tasks()
    // {
    //     $this->signIn();

    //     $project = auth()->user()->projects()->create(
    //         factory('App\Project')->raw()
    //     );
    //     $task = $project->addTask('test task');


    //     $this->patch($task->path, ['body' => 'changed'])
    //         ->assertStatus(403);

    //     $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    // }

    public function test_a_project_can_have_tasks()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();
        // $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );

        $this->post($project->path() . '/tasks', ['body' => 'test task']);

        $this->get($project->path())
            ->assertSee('test task');
    }

    public function test_a_task_can_be_updated(){
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );

        $task = $project->addTask('test task');

        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'changed',
            'completed' => true,
        ]);
            $this->assertDatabaseHas('tasks', [
                'body' => 'changed',
                'completed' => true,
            ]);
    }

    // public function test_a_task_requires_a_body()
    // {
    //     $this->signIn();

    //     $project = auth()->user()->projects()->create(
    //         factory('App\Project')->raw()
    //     );

    //     $attributes = factory('App\Task')->raw(['body' => '']);
    //     $this->post(project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    // }
}
