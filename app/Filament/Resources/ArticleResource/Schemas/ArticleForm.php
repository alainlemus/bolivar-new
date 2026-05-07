<?php

namespace App\Filament\Resources\ArticleResource\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->placeholder('Título del artículo'),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->placeholder('url-slug-unico'),
                Textarea::make('excerpt')
                    ->label('Extracto')
                    ->placeholder('Breve descripción del artículo...')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Contenido')
                    ->required()
                    ->placeholder('Contenido completo del artículo...')
                    ->columnSpanFull()
                    ->rows(10),
                TextInput::make('category')
                    ->label('Categoría')
                    ->placeholder('Guía del duelo, Necesidad inmediata, etc.'),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->directory('articles')
                    ->image(),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
                DateTimePicker::make('published_at')
                    ->label('Fecha de Publicación')
                    ->seconds(false),
            ]);
    }
}
