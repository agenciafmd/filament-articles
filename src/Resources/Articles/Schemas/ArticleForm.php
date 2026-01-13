<?php

namespace Agenciafmd\Articles\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('is_active')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('star')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtitle'),
                TextInput::make('author'),
                Textarea::make('summary')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->columnSpanFull(),
                TextInput::make('video'),
                DateTimePicker::make('published_at'),
                Textarea::make('tags')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('images')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('order')
                    ->numeric(),
            ]);
    }
}
