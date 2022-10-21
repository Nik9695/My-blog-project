<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase


{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_generation_of_token_for_correct_credentials()
    {

        $user = User::factory(1)
            ->set('name', 'Auth test')
            ->set('slug', 'auth-test')
            ->set('email', 'auth@test.com')
            ->set('password', Hash::make('password'))
            ->create()[0];

        $user->save();

        $response = $this
            ->post(
                "/api/authenticate",
                [
                    'email' => 'auth@test.com',
                    'password' => 'password',
                ],
                [
                    'Accept' => 'application/json'
                ]
            );

        $response->assertStatus(200);
    }
}
