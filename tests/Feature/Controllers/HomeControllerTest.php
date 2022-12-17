<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    protected function homeGetRoute()
    {
        return route('home.index');
    }

    public function testGuestCantSeeHome()
    {
        $response = $this->get($this->homeGetRoute());

        $response->assertRedirect();
    }

    public function testUserCanSee()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get($this->homeGetRoute());

        $response->assertViewIs('home');
    }
}
