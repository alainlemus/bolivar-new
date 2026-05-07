<?php

namespace App\Filament\Resources\SiteInfoResource\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiteInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->required()
                    ->default('Funeraria García de Bolívar'),
                TextInput::make('tagline'),
                TextInput::make('address'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('whatsapp'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Textarea::make('about_text')
                    ->columnSpanFull(),
                Textarea::make('mission_text')
                    ->columnSpanFull(),
                Textarea::make('vision_text')
                    ->columnSpanFull(),
                TextInput::make('facebook'),
                TextInput::make('instagram'),
                TextInput::make('site_logo'),
                TextInput::make('favicon'),
            ]);
    }
}
