<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory(1)
            ->set('name', 'Test User')
            ->set('slug', 'test-user')
            ->set('email', 'test@example.com')
            ->set('password', Hash::make('password'))
            ->hasArticles(3)
            ->hasLikes(3)
            ->hasComments(3)
            ->create();

        User::factory(1)
            ->set('name', 'nik')
            ->set('slug', 'nik-user')
            ->set('email', 'nik@mail.com')
            ->set('password', Hash::make('12345678'))
            ->hasArticles(3)
            ->hasComments(3)
            ->hasLikes(3)
            ->create();

        User::factory(1)
            ->set('name', 'Admin user')
            ->set('slug', 'admin-user')
            ->set('email', 'admin@user.com')
            ->set('password', Hash::make('admin_user'))
            ->set('admin_identifier', true)
            ->create();

        Article::factory(1)
            ->set('title', 'There many likes')
            ->set('content', 'Many many many likes')
            ->set('slug', 'many-likes')
            ->set('user_id', 1)
            ->hasLikes(10)
            ->create();


        Comment::factory(4)
            ->set('content', 'Many many many likes')
            ->set('user_id', 1)
            ->set('article_id', 1)
            ->hasLikes(5)
            ->create();


        $this->call([
            ArticleSeeder::class,
            CommentSeeder::class,
            CategorySeeder::class,
            LikeSeeder::class
        ]);
    }
}
