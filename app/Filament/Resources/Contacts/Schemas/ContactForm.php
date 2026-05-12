<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Placeholder::make('contact_info')
                    ->content('Información del mensaje'),
                TextInput::make('name')
                    ->label('Nombre')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->disabled()
                    ->dehydrated(false),
                Textarea::make('message')
                    ->label('Mensaje')
                    ->disabled()
                    ->dehydrated(false)
                    ->rows(4),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'pending' => 'Pendiente',
                        'read' => 'Leído',
                        'replied' => 'Respondido',
                    ])
                    ->required(),
                Textarea::make('admin_notes')
                    ->label('Notas del admin')
                    ->rows(3),
            ]);
    }
}
