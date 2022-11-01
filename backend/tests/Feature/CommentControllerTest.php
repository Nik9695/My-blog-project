<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_any_user_can_view_all_comments()
    {
        $response = $this->get('/api/comments');

        $response->assertStatus(200);

        $response->assertJson(['per_page' => 5]);
    }


    public function test_only_authenticated_user_can_create_comments()
    {
        $user = User::factory(1)->create()[0];

        $article = Article::factory(1)
            ->set('title', 'Article created for testing comments')
            ->set('content', 'Testing comments')
            ->set('slug', 'testing comments')
            ->set('user_id', 1)
            ->create()[0];


        $response = $this
            ->actingAs($user)
            ->post(
                "/api/comments",
                [
                    'content' => 'test comment',
                    'article_id' => $article->id
                ],
                [
                    'Accept' => 'application/json'
                ]
            );


        $response->assertStatus(201);

        $this->assertEquals($user->id, $response['user_id']);
        $this->assertEquals($article->id, $response['article_id']);
    }



    public function test_only_owner_can_edit_comment()
    {
        $owner = User::factory(1)->create()[0];
        $user = User::factory(1)->create()[0];


        $article = Article::factory(1)
            ->set('title', 'Article created for testing')
            ->set('content', 'Testing update comment by owner only')
            ->set('slug', 'testing update')
            ->set('user_id', $owner->id)
            ->create()[0];

        $comment = Comment::factory(1)
            ->set('user_id', $owner->id)
            ->set('article_id', $article->id)
            ->set('content', 'Testing update comment by owner only')
            ->create()[0];

        $responseFromOwner = $this
            ->actingAs($owner)
            ->put(
                "/api/comments/{$comment->id}",
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
                "/api/comments/{$comment->id}",
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
