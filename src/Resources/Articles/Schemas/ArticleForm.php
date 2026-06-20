<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Resources\Articles\Schemas;

use Agenciafmd\Admix\Resources\Forms\Components\ImageUploadMultipleWithDefault;
use Agenciafmd\Admix\Resources\Forms\Components\ImageUploadWithDefault;
use Agenciafmd\Admix\Resources\Forms\Components\RichEditorWithDefault;
use Agenciafmd\Admix\Resources\Forms\Components\YouTubeInput;
use Agenciafmd\Admix\Resources\Infolists\Components\DateTimeEntry;
use Agenciafmd\Articles\Services\ArticleService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make([
                            Section::make(__('General'))
                                ->schema([
                                    TextInput::make('title')
                                        ->translateLabel()
                                        ->generateSlug()
                                        ->autofocus()
                                        ->minLength(3)
                                        ->maxLength(255)
                                        ->required(),
                                    TextInput::make('slug')
                                        ->translateLabel()
                                        ->unique()
                                        ->required(),
                                    TextInput::make('subtitle')
                                        ->translateLabel()
                                        ->required()
                                        ->maxLength(255)
                                        ->visible(config('filament-articles.subtitle.visible', false))
                                        ->columnSpanFull(),
                                    Textarea::make('summary')
                                        ->translateLabel()
                                        ->required()
                                        ->rows(5)
                                        ->columnSpanFull(),
                                    RichEditorWithDefault::make(name: 'content', directory: 'article/content')
                                        ->translateLabel()
                                        ->required()
                                        ->columnSpanFull(),
                                    YouTubeInput::make()
                                        ->visible(config('filament-articles.video.visible', false)),
                                    ImageUploadWithDefault::make(name: 'image', directory: 'article/image', fileNameField: 'title')
                                        ->afterLabel('Max. ' . config('filament-articles.image.width', 1920) . 'x' . config('filament-articles.image.height', 1080))
                                        ->imageEditorAspectRatioOptions(config('filament-articles.image.aspect_ratio_options', ['16:9']))
                                        ->imageEditorViewportWidth(config('filament-articles.image.width', 1920))
                                        ->imageEditorViewportHeight(config('filament-articles.image.height', 1080))
                                        ->visible(config('filament-articles.image.visible', false)),
                                    ImageUploadMultipleWithDefault::make(name: 'images', directory: 'article/images', fileNameField: 'title')
                                        ->afterLabel('Max. ' . config('filament-articles.images.width', 1920) . 'x' . config('filament-articles.images.height', 1080))
                                        ->imageEditorAspectRatioOptions(config('filament-articles.images.aspect_ratio_options', ['16:9']))
                                        ->imageEditorViewportWidth(config('filament-articles.images.width', 1920))
                                        ->imageEditorViewportHeight(config('filament-articles.images.height', 1080))
                                        ->visible(config('filament-articles.images.visible', false)),
                                ])
                                ->collapsible()
                                ->columns()
                                ->columnSpan(2),
                        ])
                            ->columnSpan(2),
                        Group::make([
                            Section::make(__('Information'))
                                ->schema([
                                    Toggle::make('is_active')
                                        ->translateLabel()
                                        ->default(true),
                                    Toggle::make('star')
                                        ->translateLabel()
                                        ->default(false),
                                    DateTimePicker::make('published_at')
                                        ->translateLabel()
                                        ->columnSpanFull(),
                                    DateTimeEntry::make('created_at'),
                                    DateTimeEntry::make('updated_at'),
                                    TagsInput::make('tags')
                                        ->translateLabel()
                                        ->suggestions(fn (): array => ArticleService::make()
                                            ->tags()
                                            ->toArray())
                                        ->columnSpanFull(),
                                ])
                                ->collapsible()
                                ->columns(),
                        ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
