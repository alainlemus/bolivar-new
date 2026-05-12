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
                    ->required('El nombre es obligatorio.')
                    ->placeholder('Nombre del cliente')
                    ->maxLength(100),
                Textarea::make('text')
                    ->label('Testimonio')
                    ->required('El testimonio es obligatorio.')
                    ->placeholder('Contenido del testimonio')
                    ->columnSpanFull()
                    ->minLength(10)
                    ->maxLength(1000),
                TextInput::make('rating')
                    ->label('Calificación')
                    ->required('La calificación es obligatoria.')
                    ->numeric('La calificación debe ser un número.')
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(5),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}
