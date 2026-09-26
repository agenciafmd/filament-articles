<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Tests\Feature\Models;

use Agenciafmd\Articles\Database\Factories\ArticleFactory;
use Agenciafmd\Articles\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('builds articles from the factory class', function (): void {
    Storage::fake();

    expect(ArticleFactory::new()->make())->toBeInstanceOf(Article::class);
});

it('renders an empty paragraph when the article has no content', function (): void {
    Storage::fake();
    $article = Article::factory()->make(['content' => null]);

    expect($article->front_content->toHtml())->toBe('<p></p>');
});
