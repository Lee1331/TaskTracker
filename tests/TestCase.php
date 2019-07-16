<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null){
        //If a user is passed in then use them, otherwise create a new user
        $this->actingAs($user ?: factory('App\User')->create());
    }
}
