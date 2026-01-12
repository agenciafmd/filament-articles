<?php

namespace Agenciafmd\Articles\Models;

use Agenciafmd\Articles\Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[UseFactory(ArticleFactory::class)]
class Article extends Model
{
    use HasFactory, SoftDeletes;

    public function prunable(): Builder
    {
        return self::query()
            ->where('deleted_at', '<=', now()->subDays(30));
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
