<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTests extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->signIn();
        $this->get('/projects/create')->assertStatus(200);
        $this->followingRedirects()
            ->post('/projects', $attributes = factory('App\Project')->raw())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    public function test_a_user_can_update_a_project()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'title' => 'changed',
                'description' => 'changed',
                'notes' => 'changed',
            ])->assertRedirect($project->path());

            $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_a_user_can_update_a_projects_notes()
    {
        // $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'notes' => 'changed',
            ]);

            // $this->get($project->path(). '/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_guests_cannot_manage_projects()
    {
        // $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path(). '/edit')->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    public function test_an_authenticated_user_cannot_view_other_users_projects()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }

    public function test_an_authenticated_user_cannot_update_other_users_projects()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->patch($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title()
    {
        $this->signIn();
        $attributes = factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {

        $this->signIn();
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_a_user_can_view_their_projects()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $project = ProjectFactory::create();
        $this->actingAs($project->owner)
        ->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description);
    }


}
