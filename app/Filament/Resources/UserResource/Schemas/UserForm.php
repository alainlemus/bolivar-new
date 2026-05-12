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
                    ->required('El nombre es obligatorio.')
                    ->placeholder('Nombre del usuario')
                    ->maxLength(100),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email('El correo debe ser una dirección válida.')
                    ->required('El correo electrónico es obligatorio.')
                    ->placeholder('correo@ejemplo.com')
                    ->unique('users', 'email', ignoreRecord: true),
                DateTimePicker::make('email_verified_at')
                    ->label('Verificado el'),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required('La contraseña es obligatoria.')
                    ->placeholder('Contraseña')
                    ->minLength(8),
                Select::make('roles')
                    ->label('Roles')
                    ->multiple()
                    ->relationship('roles', 'name'),
            ]);
    }
}