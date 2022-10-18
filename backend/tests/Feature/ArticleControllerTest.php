<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;

use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    //use RefreshDatabase;
    //use DatabaseMigrations;

    public function test_user_can_create_article()
    {
        $user = User::factory(1)->create()[0];

        $category = Category::factory(1)->create()[0];

        $response = $this
            ->actingAs($user)
            ->post(
                "/api/articles",
                [
                    'title' => 'MY TEST',
                    'content' => 'test !!!',
                    'categories_id' => [$category->id]
                ],
                [
                    'Accept' => 'application/json'
                ]
            );


        $response->assertStatus(201);
        $this->assertEquals($user->id, $response['user_id']);
    }
}
