<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

//adding 'Facades' to the import statement allows Laravel to treat the import as a facade instead,
//allowing for 'ProjectFactory::withTasks(1)->create()' instead of 'app(ProjectFactory::class)->withTasks(1)->create())'
use Facades\Tests\Setup\ProjectFactory;

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
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    public function test_project_owners_can_update_existing_tasks()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
        ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function test_a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path() . '/tasks', ['body' => 'test task']);

        $this->get($project->path())
            ->assertSee('test task');
    }

    public function test_a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
        ]);
    }

    public function test_a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true,
        ]);
    }

    public function test_a_task_can_be_marked_as_incomplete()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => true,
        ]);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => false,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false,
        ]);
    }

    public function test_a_task_requires_a_body()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $project = ProjectFactory::create();


        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->acting->as($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
