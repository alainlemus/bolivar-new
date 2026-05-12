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
                    ->required('El título es obligatorio.')
                    ->placeholder('Título de la diapositiva')
                    ->maxLength(100),
                TextInput::make('subtitle')
                    ->label('Subtítulo')
                    ->placeholder('Subtítulo de la diapositiva')
                    ->maxLength(200),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->image()
                    ->required('La imagen es obligatoria.'),
                TextInput::make('order')
                    ->label('Orden')
                    ->required('El orden es obligatorio.')
                    ->numeric('El orden debe ser un número.')
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}