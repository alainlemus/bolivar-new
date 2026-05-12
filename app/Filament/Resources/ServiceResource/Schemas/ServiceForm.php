<?php

namespace App\Filament\Resources\ServiceResource\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required('El nombre es obligatorio.')
                    ->placeholder('Nombre del servicio')
                    ->maxLength(100),
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción del servicio')
                    ->columnSpanFull()
                    ->maxLength(500),
                TextInput::make('icon')
                    ->label('Icono')
                    ->placeholder('Emoji o SVG del icono')
                    ->maxLength(50),
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