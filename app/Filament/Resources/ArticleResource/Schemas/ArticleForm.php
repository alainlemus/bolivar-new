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
                    ->required('El título es obligatorio.')
                    ->placeholder('Título del artículo')
                    ->maxLength(200),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required('El slug es obligatorio.')
                    ->placeholder('url-slug-unico')
                    ->unique('articles', 'slug', ignoreRecord: true),
                Textarea::make('excerpt')
                    ->label('Extracto')
                    ->placeholder('Breve descripción del artículo...')
                    ->columnSpanFull()
                    ->maxLength(500),
                Textarea::make('content')
                    ->label('Contenido')
                    ->required('El contenido es obligatorio.')
                    ->placeholder('Contenido completo del artículo...')
                    ->columnSpanFull()
                    ->rows(10),
                TextInput::make('category')
                    ->label('Categoría')
                    ->placeholder('Guía del duelo, Necesidad inmediata, etc.')
                    ->maxLength(100),
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
