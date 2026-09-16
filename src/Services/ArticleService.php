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
        return resolve(self::class);
    }

    public function tags(): Collection
    {
        return $this->queryBuilder()
            ->pluck('tags')
            ->filter()
            ->flatten()
            ->unique()
            ->mapWithKeys(fn (string $item): array => [$item => $item])
            ->sort();
    }

    private function queryBuilder(): Builder
    {
        return Article::query();
    }
}
