<?php

namespace App\Filament\Resources\MapPlaceResource\Schemas;

use App\Models\MapPlace;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MapPlaceForm
{
    public const ALCALDIAS = [
        'Álvaro Obregón', 'Azcapotzalco', 'Benito Juárez', 'Coyoacán', 'Cuajimalpa de Morelos', 'Cuauhtémoc',
        'Gustavo A. Madero', 'Iztacalco', 'Iztapalapa', 'La Magdalena Contreras', 'Miguel Hidalgo', 'Milpa Alta',
        'Tláhuac', 'Tlalpan', 'Venustiano Carranza', 'Xochimilco',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('type')->label('Tipo')->options(MapPlace::TYPES)->required()->default('panteon'),
            TextInput::make('name')->label('Nombre')->required()->maxLength(255),
            TextInput::make('address')->label('Dirección')->maxLength(255)->columnSpanFull(),
            Select::make('alcaldia')->label('Alcaldía')->options(array_combine(self::ALCALDIAS, self::ALCALDIAS))->searchable(),
            TextInput::make('phone')->label('Teléfono')->tel()->maxLength(40),
            TextInput::make('lat')->label('Latitud')->numeric()->required()->helperText('Ej. 19.4326. Clic derecho en Google Maps → copia las coordenadas.'),
            TextInput::make('lng')->label('Longitud')->numeric()->required()->helperText('Ej. -99.1332'),
            Select::make('sector')->label('Sector')->options(['publico' => 'Público', 'privado' => 'Privado']),
            TextInput::make('source')->label('Fuente')->maxLength(255),
            Toggle::make('is_active')->label('Visible en el mapa')->default(true),
        ]);
    }
}
