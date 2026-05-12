<?php

namespace App\Filament\Resources\QrCodes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QrCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del QR')
                    ->required('El nombre es obligatorio.')
                    ->placeholder('ej: Folleto 2024')
                    ->maxLength(100),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}