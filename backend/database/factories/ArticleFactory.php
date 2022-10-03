<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Utils\StringUtils;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();
        $slug = StringUtils::slugify($title);
        $content = fake()->realText();
        $summary = StringUtils::summarize($content);

        return [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'summary' => $summary
        ];
    }
}
