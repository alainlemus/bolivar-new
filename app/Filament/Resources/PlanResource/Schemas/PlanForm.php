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
                    ->required()
                    ->placeholder('Nombre del plan'),
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción del plan')
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label('Precio (MXN)')
                    ->required()
                    ->numeric()
                    ->placeholder('0.00'),
                FileUpload::make('icon')
                    ->label('Imagen')
                    ->image()
                    ->directory('plan-images'),
                Textarea::make('features')
                    ->label('Características')
                    ->placeholder('["Característica 1", "Característica 2"]')
                    ->columnSpanFull(),
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