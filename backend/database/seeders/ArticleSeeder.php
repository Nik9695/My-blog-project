<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
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
        /*   $category = Category::factory(1)
            ->set('name', 'adventure')
            ->create(); */

        /*       Article::factory(2)
            ->hasComments(1)
            ->afterCreating(function (Article $article) {

                $category = Category::where('name', 'adventure');
                $article->categories()->attach($category);
            })
            ->create(); */


        /*         $article = new Article([
            'title' => 'manually created',
            'content' => 'manual content',
            'slug' => 'manual slug',
            'user_id' => User::factory(1)->createOne()->id,
        ]); */

        //$article->save();
    }
}
