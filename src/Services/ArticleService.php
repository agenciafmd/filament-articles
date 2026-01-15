<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Services;

use Agenciafmd\Articles\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class ArticleService
{
    public static function make(): static
    {
        return app(self::class);
    }

    public function tags(): Collection
    {
        return $this->queryBuilder()
            ->pluck('tags')
            ->filter()
            ->flatten()
            ->unique()
            ->mapWithKeys(fn ($item) => [$item => $item])
            ->sort();
    }

    private function queryBuilder(): Builder
    {
        return Article::query();
    }
}
