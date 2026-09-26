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

    /**
     * Marcadores já usados nos artigos, sem repetição.
     *
     * @return Collection<string, string>
     */
    public function tags(): Collection
    {
        return $this->queryBuilder()
            ->pluck('tags')
            ->filter(static fn (mixed $tags): bool => is_array($tags))
            ->flatten()
            ->filter(static fn (mixed $tag): bool => is_string($tag))
            ->unique()
            ->mapWithKeys(static fn (string $tag): array => [$tag => $tag])
            ->sort();
    }

    /**
     * @return Builder<Article>
     */
    private function queryBuilder(): Builder
    {
        return Article::query();
    }
}
