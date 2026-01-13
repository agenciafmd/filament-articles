<?php

declare(strict_types=1);

namespace Agenciafmd\Articles\Resources\Articles\Schemas;

use Agenciafmd\Admix\Resources\Schemas\Components\DateTimePickerDisabled;
use Agenciafmd\Admix\Resources\Schemas\Components\ImageUploadMultipleWithDefault;
use Agenciafmd\Admix\Resources\Schemas\Components\ImageUploadWithDefault;
use Agenciafmd\Admix\Resources\Schemas\Components\RichEditorWithDefault;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
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
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('summary')
                            ->translateLabel()
                            ->rows(5)
                            ->columnSpanFull(),
                        RichEditorWithDefault::make(name: 'content', directory: 'user/content')
                            ->translateLabel()
                            ->columnSpanFull(),

                        //                        TextInput::make('video'),
                        //                        Textarea::make('tags')
                        //                            ->columnSpanFull(),
                        ImageUploadWithDefault::make(name: 'image', directory: 'user/image', fileNameField: 'title'),
                        ImageUploadMultipleWithDefault::make(name: 'images', directory: 'user/images', fileNameField: 'title'),
                        TagsInput::make('tags')
                            ->translateLabel()
                            ->columnSpanFull(),
                        //                        FileUpload::make('image')
                        //                            ->image(),
                        //                        Textarea::make('images')
                        //                            ->columnSpanFull(),
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

        //        return $schema
        //            ->components([
        //                TextInput::make('is_active')
        //                    ->required()
        //                    ->numeric()
        //                    ->default(1),
        //                TextInput::make('star')
        //                    ->required()
        //                    ->numeric()
        //                    ->default(0),
        //                TextInput::make('title')
        //                    ->required(),
        //                TextInput::make('subtitle'),
        //                TextInput::make('author'),
        //                Textarea::make('summary')
        //                    ->columnSpanFull(),
        //                Textarea::make('content')
        //                    ->columnSpanFull(),
        //                TextInput::make('video'),
        //                DateTimePicker::make('published_at'),
        //                Textarea::make('tags')
        //                    ->columnSpanFull(),
        //                FileUpload::make('image')
        //                    ->image(),
        //                Textarea::make('images')
        //                    ->columnSpanFull(),
        //                TextInput::make('slug')
        //                    ->required(),
        //                TextInput::make('order')
        //                    ->numeric(),
        //            ]);
    }
}
