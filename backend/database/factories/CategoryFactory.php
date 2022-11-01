<?php

namespace Database\Factories;

use App\Utils\StringUtils;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->sentence(2);
        $slug = StringUtils::slugify($name);

        return compact('slug', 'name');
    }
}
