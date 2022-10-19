<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    //use DatabaseMigrations;

    //use RefreshDatabase;

    use DatabaseTransactions;

    public function test_any_user_can_view_all_articles()
    {
        $response = $this->get('/api/articles');

        $response->assertStatus(200);

        $response->assertJson(['per_page' => 5]);
    }

    public function test_any_user_can_view_article_by_id()
    {

        $article = Article::factory(1)
            ->set('title', 'Article created for testing')
            ->set('content', 'Testing update article by owner only')
            ->set('slug', 'testing update')
            ->create()[0];

        $response = $this->get("/api/articles/{$article->id}");

        $response->assertStatus(200);
    }

    public function test_only_authenticated_user_can_create_article()
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

    public function test_only_owner_can_edit_article()
    {
        $owner = User::factory(1)->create()[0];
        $user = User::factory(1)->create()[0];


        $article = Article::factory(1)
            ->set('title', 'Article created for testing')
            ->set('content', 'Testing update article by owner only')
            ->set('slug', 'testing update')
            ->set('user_id', $owner->id)
            ->create()[0];


        $responseFromOwner = $this
            ->actingAs($owner)
            ->put(
                "/api/articles/{$article->id}",
                [
                    'content' => 'Test of update method',
                ],
                [
                    'Accept' => 'application/json'
                ]
            );

        $responseFromUser = $this
            ->actingAs($user)
            ->put(
                "/api/articles/{$article->id}",
                [
                    'content' => 'Test of update method',
                ],
                [
                    'Accept' => 'application/json'
                ]
            );

        $responseFromOwner->assertStatus(200);
        $responseFromUser->assertStatus(403);

        $this->assertEquals($owner->id, $responseFromOwner['user_id']);
    }
}
