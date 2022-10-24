<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PhpParser\Builder\Use_;
use Tests\TestCase;

class ArticleReactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_reaction_get()
    {
        $article = Article::factory()->createOne();
        $reactions = Reaction::factory(3)
            ->set('reactable_id', $article->id)
            ->set('reactable_type', 'article')
            ->create();

        $response = $this->getJson("/api/articles/{$article->id}/reactions");

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_reaction_post()
    {
        $article = Article::factory()->createOne();
        $reactingUser = User::factory(1)->create()[0];

        $response = $this->actingAs($reactingUser)->postJson("/api/articles/{$article->id}/reactions", ['type' => 'heart']);

        $response->assertStatus(201);

        $response->assertJson([
            'reactable_id' => $article->id,
            'reactable_type' => 'article',
            'type' => 'heart',
            'user_id' => $reactingUser->id
        ]);

        $reactions = Reaction::all();
        $this->assertCount(1, $reactions);
    }
}
