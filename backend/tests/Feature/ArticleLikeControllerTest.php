<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ArticleLikeControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_any_user_can_view_all_likes_on_any_article()
    {

        $article = Article::factory(1)
            ->set('title', 'Article created for testing comments')
            ->set('content', 'Testing comments')
            ->set('slug', 'testing comments')
            ->set('user_id', 1)
            ->create()[0];

        $response = $this->get("/api/articles/{$article->id}/likes");

        $response->assertStatus(200);
    }
}
