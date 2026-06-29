<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Articles\Database\Factories\ArticleFactory;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

#[UseFactory(ArticleFactory::class)]
final class Article extends Model implements AuditableContract
{
    use Auditable;
    use HasFactory;
    use Prunable;
    use SoftDeletes;
    use WithScopes;

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

    protected function frontContent(): Attribute
    {
        return Attribute::make(
            get: static fn (mixed $value, array $attributes): RichContentRenderer => RichContentRenderer::make($attributes['content']),
        );
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: static fn (mixed $value, array $attributes): string => route(
                'frontend.articles.show',
                $attributes['slug']),
        );
    }

    #[Override]
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
