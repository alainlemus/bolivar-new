<?php

namespace App\Filament\Resources\ObituaryResource\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
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
                    ->placeholder('Nombre completo del fallecido'),
                DateTimePicker::make('date_of_death')
                    ->label('Fecha de Fallecimiento')
                    ->required()
                    ->seconds(false),
                DateTimePicker::make('date_of_birth')
                    ->label('Fecha de Nacimiento')
                    ->seconds(false),
                TextInput::make('age')
                    ->label('Edad')
                    ->numeric()
                    ->placeholder('Edad'),
                TextInput::make('relationship')
                    ->label('Parentesco')
                    ->placeholder('Parentesco con el responsable'),
                TextInput::make('responsible_name')
                    ->label('Nombre del Responsable')
                    ->required()
                    ->placeholder('Nombre completo'),
                TextInput::make('responsible_phone')
                    ->label('Teléfono del Responsable')
                    ->tel()
                    ->placeholder('Teléfono de contacto'),
                TextInput::make('responsible_email')
                    ->label('Correo del Responsable')
                    ->email()
                    ->placeholder('Correo electrónico'),
                Textarea::make('obituary_text')
                    ->label('Texto del Obituario')
                    ->placeholder('Contenido del obituario...')
                    ->columnSpanFull(),
                TextInput::make('chapel')
                    ->label('Capilla')
                    ->placeholder('Nombre de la capilla'),
                DateTimePicker::make('velatorio_start')
                    ->label('Inicio del Velatorio')
                    ->seconds(false),
                DateTimePicker::make('velatorio_end')
                    ->label('Fin del Velatorio')
                    ->seconds(false),
                DateTimePicker::make('departure_time')
                    ->label('Hora de Salida')
                    ->seconds(false),
                TextInput::make('destination')
                    ->label('Destino')
                    ->placeholder('Lugar de destino'),
                TextInput::make('cemetery')
                    ->label('Cementerio')
                    ->placeholder('Nombre del cementerio'),
                DateTimePicker::make('burial_date')
                    ->label('Fecha de Sepelio')
                    ->seconds(false),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->directory('obituaries')
                    ->image(),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}