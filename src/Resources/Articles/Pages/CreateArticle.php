<?php

namespace Agenciafmd\Articles\Resources\Articles\Pages;

use Agenciafmd\Articles\Resources\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
