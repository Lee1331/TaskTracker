<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Facades\Tests\Setup\ProjectFactory;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_project_can_invite_a_user()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();
        $userToInvite = factory('App\User')->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $userToInvite->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    public function test_non_owners_may_not_invite_other_users()
    {
        $project = ProjectFactory::create();

        $user = factory('App\User')->create();

        $assertInvitationForbidden = function () use ($user, $project) {
            $this->actingAs($user)
                ->post($project->path() . '/invitations')
                ->assertStatus(403);
        };

        $assertInvitationForbidden();

        $project->invite($user);

        $assertInvitationForbidden();

    }

    public function test_the_email_address_must_be_associated_with_a_valid_account()
    {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notauser@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have an account with this site.'
            ], null, 'invitations');
    }

    public function test_invited_users_may_update_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = factory('App\User')->create());

        $this->actingAs($newUser)->post(action('ProjectTasksController@store', $project), $task = ['body' => 'new task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
