<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory(2)
            ->hasComments(1)
            ->create();

        $article = new Article([
            'title' => 'manually created',
            'content' => 'manual content',
            'slug' => 'manual slug',
            'user_id' => User::factory(1)->createOne()->id,
        ]);

        $article->save();
    }
}
