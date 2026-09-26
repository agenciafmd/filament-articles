<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Database\Factories;

use Agenciafmd\Articles\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Article>
 */
final class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);
        $slug = str($title)->slug();

        return [
            'is_active' => fake()->boolean(),
            'star' => fake()->boolean(),
            'title' => $title,
            'subtitle' => config('filament-articles.subtitle.visible') ? fake()->sentence(8) : null,
            'summary' => fake()->text(),
            'content' => fake()->htmlParagraphs(),
            'video' => config('filament-articles.video.visible') ? fake()->youtubeRandomUri() : null,
            'published_at' => fake()->dateTimeBetween(now()->subMonths(6), now()->addDay()),
            'tags' => fake()->tags(),
            'image' => config('filament-articles.image.visible') ? Storage::putFile('fake', fake()->localImage(ratio: '16:9')) : null,
            'images' => config('filament-articles.images.visible') ? collect(range(0, fake()->numberBetween(1, 6)))
                ->map(fn () => Storage::putFile('fake', fake()->localImage(ratio: '16:9')))
                ->all() : [],
            'slug' => $slug,
        ];
    }
}
