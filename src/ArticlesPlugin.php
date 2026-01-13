<?php

declare(strict_types=1);

namespace Agenciafmd\Articles;

use Agenciafmd\Articles\Resources\Articles\ArticleResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

final class ArticlesPlugin implements Plugin
{
    public static function make(): static
    {
        return app(self::class);
    }

    public function getId(): string
    {
        return 'articles';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                ArticleResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
