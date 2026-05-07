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
                    ->required()
                    ->placeholder('Nombre del servicio'),
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción del servicio')
                    ->columnSpanFull(),
                TextInput::make('icon')
                    ->label('Icono')
                    ->placeholder('Emoji o icono'),
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