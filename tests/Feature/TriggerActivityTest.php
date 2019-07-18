<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creating_a_project()
    {
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    public function test_updating_a_project()
    {
        $project = ProjectFactory::create();

        $project->update(['title' => 'changed']);
        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }

    public function test_creating_a_new_task()
    {
        $project = ProjectFactory::create();
        $project->addTask('new task');

        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function($activity){
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf('App\Task', $activity->subject);
            $this->assertEquals('new task', $activity->subject->body);

        });
    }

    public function test_completing_a_task()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'test',
                'completed' => true,
            ]);

        $this->assertCount(3, $project->activity);

        tap($project->activity->last(), function($activity){
            $this->assertEquals('completed_task', $activity->description);
            $this->assertInstanceOf('App\Task', $activity->subject);

        });
    }

    public function test_incompleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'test',
                'completed' => true,
            ]);

        $this->assertCount(3, $project->activity);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'test',
            'completed' => false,
        ]);

        $project->refresh();
        $this->assertCount(4, $project->activity);

        $this->assertEquals('incompleted_task', $project->activity->last()->description);
    }

    public function test_deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $project->tasks[0]->delete();
        $this->assertCount(3, $project->activity);

    }
}
