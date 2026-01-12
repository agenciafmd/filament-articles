<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Providers;

use Filament\Panel;
use Filament\PanelProvider;

final class FilamentPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        //
    }

    public function panel(Panel $panel): Panel
    {
        return $panel;
    }
}
