<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    protected function homeRoute()
    {
        return route('home.index');
    }

    protected function loginGetRoute()
    {
        return route('login.show');
    }

    protected function loginPostRoute()
    {
        return route('login.perform');
    }

    protected function logoutRoute()
    {
        return route('logout.perform');
    }

    protected function successfulLogoutRoute()
    {
        return route('login.show');
    }

    public function testUserCanViewALoginForm()
    {
        $response = $this->get($this->loginGetRoute());

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testUserCannotViewALoginFormWhenAuthenticated()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get($this->loginGetRoute());

        $response->assertRedirect($this->homeRoute());
    }

    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = User::find(1);

        $response = $this->post($this->loginPostRoute(), [
            'username' => 'root',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }


    public function testUserCannotLoginWithIncorrectPassword()
    {
        $response = $this->post($this->loginPostRoute(), [
            'username' => 'root',
            'password' => 'passwordWrong',
        ]);

        $response->assertStatus(401);
    }

    public function testUserCannotLoginWithUsernameThatDoesNotExist()
    {
        $response = $this->post($this->loginPostRoute(), [
            'username' => 'rootWrong',
            'password' => 'password',
        ]);

        $response->assertStatus(401);
    }

    public function testUserCanLogout()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get($this->logoutRoute());

        $response->assertRedirect($this->successfulLogoutRoute());
        $this->assertGuest();
    }
}
