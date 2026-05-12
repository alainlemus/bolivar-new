<?php

namespace App\Filament\Resources\PlanResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required('El nombre es obligatorio.')
                    ->placeholder('Nombre del plan')
                    ->maxLength(100),
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción del plan')
                    ->columnSpanFull()
                    ->maxLength(500),
                TextInput::make('price')
                    ->label('Precio (MXN)')
                    ->required('El precio es obligatorio.')
                    ->numeric('El precio debe ser un número.')
                    ->placeholder('0.00')
                    ->minValue(0),
                FileUpload::make('icon')
                    ->label('Imagen')
                    ->image()
                    ->directory('plan-images')
                    ->helperText('Imagen JPG o PNG para el plan'),
                Textarea::make('features')
                    ->label('Características')
                    ->placeholder('["Característica 1", "Característica 2"]')
                    ->columnSpanFull()
                    ->helperText('Ingresa las características en formato JSON'),
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