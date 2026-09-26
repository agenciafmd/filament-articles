<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Database\Seeders;

use Agenciafmd\Articles\Database\Factories\ArticleFactory;
use Agenciafmd\Articles\Models\Article;
use Illuminate\Database\Seeder;

final class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::query()
            ->truncate();

        ArticleFactory::new()
            ->count(50)
            ->create();
    }
}
