<?php

namespace App\Filament\Resources\SlideResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->placeholder('Título de la diapositiva'),
                TextInput::make('subtitle')
                    ->label('Subtítulo')
                    ->placeholder('Subtítulo de la diapositiva'),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->image()
                    ->required(),
                TextInput::make('order')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}