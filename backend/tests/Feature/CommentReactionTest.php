<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentReactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_reaction_get()
    {
        $comment = Comment::factory()->createOne();

        $reactions = Reaction::factory(3)
            ->set('reactable_id', $comment->id)
            ->set('reactable_type', 'comment')
            ->create();

        $response = $this->getJson("/api/comments/{$comment->id}/reactions");

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_reaction_post()
    {
        $comment = Comment::factory()->createOne();
        $reactingUser = User::factory(1)->create()[0];

        $response = $this->actingAs($reactingUser)->postJson(
            "/api/comments/{$comment->id}/reactions",
            ['type' => 'heart']
        );

        $response->assertStatus(201);

        $response->assertJson([
            'reactable_id' => $comment->id,
            'reactable_type' => 'comment',
            'type' => 'heart',
            'user_id' => $reactingUser->id
        ]);

        $reactions = Reaction::all();
        $this->assertCount(1, $reactions);
    }
}
