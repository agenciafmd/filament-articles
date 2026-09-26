<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Tests\Feature\Services;

use Agenciafmd\Articles\Models\Article;
use Agenciafmd\Articles\Services\ArticleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('lists each tag once and in alphabetical order', function (): void {
    Storage::fake();
    Article::factory()->create(['tags' => ['Projetos', 'Economia']]);
    Article::factory()->create(['tags' => ['Economia']]);
    Article::factory()->create(['tags' => null]);

    expect(ArticleService::make()->tags()->all())->toBe([
        'Economia' => 'Economia',
        'Projetos' => 'Projetos',
    ]);
});
