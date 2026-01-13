<?php

namespace Agenciafmd\Articles\Resources\Articles\Pages;

use Agenciafmd\Admix\Resources\Concerns\RedirectBack;
use Agenciafmd\Articles\Resources\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    use RedirectBack;

    protected static string $resource = ArticleResource::class;
}
