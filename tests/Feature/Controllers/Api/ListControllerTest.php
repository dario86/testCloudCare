<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Tests\TestCase;

class ListControllerTest extends TestCase
{
    protected function listGetRoute()
    {
        return '/api/list';
    }

    public function testWithValidToken()
    {
        $user = User::find(1);
        $token = $user->createToken($user->username)->accessToken;
        $this->get($this->listGetRoute(). '?token=' . $token->token)
            ->assertStatus(200);
    }

    public function testSeeWithUnvalidToken()
    {
        $user = User::find(1);
        $token = '12345';
        $this->actingAs($user)->get($this->listGetRoute(). '?token=' . $token)
            ->assertStatus(500);
    }
}
