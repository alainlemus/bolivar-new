<?php

namespace App\Filament\Resources\TestimonialResource\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->placeholder('Nombre del cliente'),
                Textarea::make('text')
                    ->label('Testimonio')
                    ->required()
                    ->placeholder('Contenido del testimonio')
                    ->columnSpanFull(),
                TextInput::make('branch')
                    ->label('Sucursal')
                    ->placeholder('Ej: Casa Prim, Sucursal Aeropuerto'),
                TextInput::make('rating')
                    ->label('Calificación')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}
