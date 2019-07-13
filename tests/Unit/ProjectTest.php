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
        $this->assertEquals('/projects/' . $project-id, $project->path());
    }
}
