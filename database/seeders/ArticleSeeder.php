<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Database\Seeders;

use Agenciafmd\Articles\Models\Article;
use Illuminate\Database\Seeder;

final class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::query()
            ->truncate();

        Article::factory()
            ->count(50)
            ->create();
    }
}
