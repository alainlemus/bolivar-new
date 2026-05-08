<?php

namespace App\Filament\Resources\SiteInfoResource\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
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
                    ->label('Nombre del Sitio')
                    ->required()
                    ->default('Funeraria García de Bolívar'),
                TextInput::make('tagline')
                    ->label('Lema')
                    ->placeholder('Lema del sitio'),
                TextInput::make('address')
                    ->label('Dirección')
                    ->placeholder('Dirección de la funeraria'),
                Textarea::make('map_url')
                    ->label('Código embebido de Google Maps')
                    ->placeholder('Pega aquí el código iframe de Google Maps')
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->placeholder('Teléfono de contacto'),
                TextInput::make('phone_2')
                    ->label('Teléfono 2')
                    ->placeholder('Segundo teléfono (opcional)'),
                TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->tel()
                    ->placeholder('Número de WhatsApp'),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->placeholder('correo@ejemplo.com'),
                Textarea::make('about_text')
                    ->label('Texto About')
                    ->placeholder('Texto para la sección Nosotros')
                    ->columnSpanFull(),
                FileUpload::make('gallery_images')
                    ->label('Galería de Imágenes (Quiénes Somos)')
                    ->disk('public')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->appendFiles(),
                Textarea::make('mission_text')
                    ->label('Texto Misión')
                    ->placeholder('Texto de la misión')
                    ->columnSpanFull(),
                Textarea::make('vision_text')
                    ->label('Texto Visión')
                    ->placeholder('Texto de la visión')
                    ->columnSpanFull(),
                TextInput::make('facebook')
                    ->label('Facebook')
                    ->placeholder('URL de Facebook'),
                TextInput::make('instagram')
                    ->label('Instagram')
                    ->placeholder('URL de Instagram'),
                RichEditor::make('privacy_notice')
                    ->label('Aviso de Privacidad')
                    ->placeholder('Contenido del aviso de privacidad...')
                    ->columnSpanFull()
                    ->toolbarButtons(['bold', 'italic', 'orderedList', 'bulletList', 'link', 'undo', 'redo']),
                FileUpload::make('site_logo')
                    ->label('Logo del Sitio')
                    ->disk('public')
                    ->image(),
                FileUpload::make('favicon')
                    ->label('Favicon')
                    ->disk('public')
                    ->image(),
            ]);
    }
}