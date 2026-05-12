<?php

namespace App\Filament\Resources\ObituaryResource\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ObituaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('deceased_name')
                    ->label('Nombre del Fallecido')
                    ->required()
                    ->placeholder('Nombre completo'),
                DateTimePicker::make('date_of_death')
                    ->label('Fecha de Fallecimiento')
                    ->required(),
                TextInput::make('age')
                    ->label('Edad')
                    ->numeric()
                    ->placeholder('Edad'),
                TextInput::make('chapel')
                    ->label('Lugar de Último Descanso')
                    ->placeholder('Capilla o lugar'),
                DateTimePicker::make('velatorio_start')
                    ->label('Fecha y Hora de Ingreso al Velatorio'),
                DateTimePicker::make('velatorio_end')
                    ->label('Fecha y Hora de Salida del Velatorio'),
                TextInput::make('departure_time')
                    ->label('Hora de Salida'),
                TextInput::make('destination')
                    ->label('Destino')
                    ->placeholder('Cementerio / Horno crematorio / Traslado a provincia'),
                DateTimePicker::make('burial_date')
                    ->label('Fecha y Hora del Destino')
                    ->helperText('Fecha y hora de inhumación, cremación o traslado'),
                Textarea::make('obituary_text')
                    ->label('Mensaje de la Familia')
                    ->placeholder('Mensaje para el obituario...')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
                DateTimePicker::make('start_date')
                    ->label('Fecha de Inicio de Publicación')
                    ->helperText('Desde cuándo aparece en el obituario'),
                DateTimePicker::make('end_date')
                    ->label('Fecha de Fin de Publicación')
                    ->helperText('Hasta cuándo aparece en el obituario'),
            ]);
    }
}