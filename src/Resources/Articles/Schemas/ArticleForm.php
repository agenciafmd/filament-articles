<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Resources\Articles\Schemas;

use Agenciafmd\Admix\Resources\Schemas\Components\DateTimePickerDisabled;
use Agenciafmd\Admix\Resources\Schemas\Components\ImageUploadMultipleWithDefault;
use Agenciafmd\Admix\Resources\Schemas\Components\ImageUploadWithDefault;
use Agenciafmd\Admix\Resources\Schemas\Components\RichEditorWithDefault;
use Agenciafmd\Articles\Services\ArticleService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

final class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('General'))
                    ->schema([
                        TextInput::make('title')
                            ->translateLabel()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if (($get('slug') ?? '') !== str($old)->slug()->toString()) {
                                    return;
                                }

                                $set('slug', str($state)->slug()->toString());
                            })
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
                        TextInput::make('video')
                            ->translateLabel()
                            ->visible(config('filament-articles.video.visible', false)),
                        ImageUploadWithDefault::make(name: 'image', directory: 'article/image', fileNameField: 'title')
                            ->imageEditorAspectRatioOptions(config('filament-articles.image.aspect_ratio_options', ['16:9']))
                            ->imageEditorViewportWidth(config('filament-articles.image.width', 1920))
                            ->imageEditorViewportHeight(config('filament-articles.image.height', 1080))
                            ->visible(config('filament-articles.image.visible', false)),
                        ImageUploadMultipleWithDefault::make(name: 'images', directory: 'article/images', fileNameField: 'title')
                            ->imageEditorAspectRatioOptions(config('filament-articles.images.aspect_ratio_options', ['16:9']))
                            ->imageEditorViewportWidth(config('filament-articles.images.width', 1920))
                            ->imageEditorViewportHeight(config('filament-articles.images.height', 1080))
                            ->visible(config('filament-articles.images.visible', false)),
                        TagsInput::make('tags')
                            ->translateLabel()
                            ->suggestions(fn (): array => ArticleService::make()
                                ->tags()
                                ->toArray())
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columns()
                    ->columnSpan(2),
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
                        //                        TextInput::make('author')
                        //                            ->translateLabel()
                        //                            ->maxLength(255),
                        DateTimePickerDisabled::make('created_at'),
                        DateTimePickerDisabled::make('updated_at'),
                    ])
                    ->collapsible()
                    ->columns(),
            ])
            ->columns(3);
    }
}
