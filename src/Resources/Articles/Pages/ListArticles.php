<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Resources\Articles\Pages;

use Agenciafmd\Articles\Resources\Articles\ArticleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Override;

final class ListArticles extends ListRecords
{
    #[Override]
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
