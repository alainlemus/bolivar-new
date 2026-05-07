<?php

namespace App\Filament\Resources\UserResource\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->placeholder('Nombre del usuario'),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required()
                    ->placeholder('correo@ejemplo.com'),
                DateTimePicker::make('email_verified_at')
                    ->label('Verificado el'),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required()
                    ->placeholder('Contraseña'),
                Select::make('roles')
                    ->label('Roles')
                    ->multiple()
                    ->relationship('roles', 'name'),
            ]);
    }
}