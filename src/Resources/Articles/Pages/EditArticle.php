<?php

namespace Agenciafmd\Articles\Resources\Articles\Pages;

use Agenciafmd\Admix\Resources\Concerns\RedirectBack;
use Agenciafmd\Articles\Resources\Articles\ArticleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    use RedirectBack;

    protected static string $resource = ArticleResource::class;

    protected $listeners = [
        'auditRestored',
    ];

    public function auditRestored(): void
    {
        $this->fillForm();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
