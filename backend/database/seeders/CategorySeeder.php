<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(1)
            ->set('name', 'adventure')
            ->create();

        Category::factory(1)
            ->set('name', 'fashion')
            ->create();

        Category::factory(1)
            ->set('name', 'brand')
            ->create();

        Category::factory(1)
            ->set('name', 'science')
            ->create();
    }
}
