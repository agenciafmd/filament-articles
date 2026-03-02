<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Models;

use Agenciafmd\Articles\Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

#[UseFactory(ArticleFactory::class)]
final class Article extends Model implements AuditableContract
{
    use Auditable, HasFactory, Prunable, SoftDeletes;

    protected array $defaultSort = [
        'is_active' => 'desc',
        'star' => 'desc',
        'published_at' => 'desc',
        'title' => 'asc',
    ];

    public function prunable(): Builder
    {
        return self::query()
            ->where('deleted_at', '<=', now()->subDays(30));
    }

    #[Scope]
    protected function isActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    #[Scope]
    protected function sort(Builder $query): void
    {
        $defaultSort = $this->defaultSort ?? [
            'is_active' => 'desc',
            'name' => 'asc',
        ];

        foreach ($defaultSort as $field => $direction) {
            if ($field === 'sort') {
                $query->orderByRaw('-' . $query->qualifyColumn('sort') . ' DESC');
            } else {
                $query->orderBy($query->qualifyColumn($field), $direction);
            }
        }
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'star' => 'boolean',
            'tags' => 'array',
            'images' => 'array',
            'published_at' => 'timestamp',
        ];
    }
}
