<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Database\Factories\UserFactory;
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
            ->hasComments(3)
            ->create();

        User::factory(1)
            ->set('name', 'other User')
            ->set('slug', 'other-user')
            ->set('email', 'other@example.com')
            ->set('password', Hash::make('password'))
            ->hasArticles(3)
            ->hasComments(3)
            ->create();

        User::factory(1)
            ->set('name', 'Admin user')
            ->set('slug', 'admin-user')
            ->set('email', 'admin@user.com')
            ->set('password', Hash::make('admin_user'))
            ->set('admin_identifier', true)
            ->create();

        (new UserFactory(2))
            ->set('name', 'user without posts')
            ->create();

        $this->call([
            ArticleSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
