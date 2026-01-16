<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(4);
        $slug = str()->slug($title);

        return [
            'is_active' => fake()->boolean(),
            'star' => fake()->boolean(),
            'title' => $title,
            'subtitle' => fake()->sentence(8),
            'summary' => fake()->text(),
            'content' => fake()->paragraphs(6, true),
            'video' => fake()->youtubeRandomUri(),
            'published_at' => fake()->dateTimeBetween(now()->subMonths(6), now()->addDay()),
            'tags' => null, // fake()->text(),
            'image' => null, // fake()->regexify('[A-Za-z0-9]{255}'),
            'images' => null, // fake()->text(),
            'slug' => $slug,
        ];
    }
}
