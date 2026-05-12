<?php

namespace App\Filament\Resources\SiteInfoResource\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
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
                TextInput::make('admin_email')
                    ->label('Correo del Admin')
                    ->email()
                    ->placeholder('Correo donde recibir mensajes de contacto')
                    ->helperText('Recibirás una copia de los mensajes enviados desde el formulario de contacto'),
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
                FileUpload::make('nosotros_banner')
                    ->label('Banner de Nosotros (Imagen o Video)')
                    ->disk('public')
                    ->acceptedFileTypes(['image/*', 'video/*'])
                    ->helperText('Imagen o video para el banner de la página Nosotros')
                    ->columnSpanFull(),
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
                    ->acceptedFileTypes(['image/svg+xml', 'image/svg', 'image/png', 'image/jpeg', 'image/webp'])
                    ->helperText('Formatos: SVG, PNG, JPEG, WebP'),
                FileUpload::make('favicon')
                    ->label('Favicon')
                    ->disk('public')
                    ->acceptedFileTypes(['image/svg+xml', 'image/svg', 'image/x-icon', 'image/png']),
                Section::make('SEO')
                    ->description('Configuración para motores de búsqueda y redes sociales')
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Título Meta')
                            ->placeholder('Título para motores de búsqueda (max 60 caracteres)')
                            ->maxLength(60)
                            ->validationMessages([
                                'max' => 'El título no puede exceder 60 caracteres.',
                            ]),
                        Textarea::make('meta_description')
                            ->label('Descripción Meta')
                            ->placeholder('Descripción para motores de búsqueda (max 160 caracteres)')
                            ->rows(3)
                            ->maxLength(160)
                            ->validationMessages([
                                'max' => 'La descripción no puede exceder 160 caracteres.',
                            ]),
                        Textarea::make('meta_keywords')
                            ->label('Palabras Clave')
                            ->placeholder('Palabras clave separadas por coma'),
                        TextInput::make('canonical_url')
                            ->label('URL Canónica')
                            ->placeholder('URL canónica del sitio')
                            ->url('La URL debe ser válida'),
                        TextInput::make('robots')
                            ->label('Robots')
                            ->default('index, follow')
                            ->helperText('Ej: index, follow / noindex, nofollow'),
                    ]),
                Section::make('Open Graph (Facebook)')
                    ->description('Configuración para compartir en Facebook')
                    ->collapsed()
                    ->schema([
                        TextInput::make('og_title')
                            ->label('Título OG')
                            ->placeholder('Título para Facebook (max 95 caracteres)')
                            ->maxLength(95)
                            ->validationMessages([
                                'max' => 'El título no puede exceder 95 caracteres.',
                            ]),
                        Textarea::make('og_description')
                            ->label('Descripción OG')
                            ->placeholder('Descripción para Facebook (max 200 caracteres)')
                            ->rows(2)
                            ->maxLength(200)
                            ->validationMessages([
                                'max' => 'La descripción no puede exceder 200 caracteres.',
                            ]),
                        FileUpload::make('og_image')
                            ->label('Imagen OG')
                            ->disk('public')
                            ->image()
                            ->helperText('Imagen recomendada: 1200x630px'),
                    ]),
                Section::make('Twitter Card')
                    ->description('Configuración para compartir en Twitter')
                    ->collapsed()
                    ->schema([
                        Select::make('twitter_card')
                            ->label('Tipo de Card')
                            ->default('summary_large_image')
                            ->options([
                                'summary' => 'Summary',
                                'summary_large_image' => 'Summary Large Image',
                            ]),
                        TextInput::make('twitter_title')
                            ->label('Título Twitter')
                            ->placeholder('Título para Twitter (max 70 caracteres)')
                            ->maxLength(70)
                            ->validationMessages([
                                'max' => 'El título no puede exceder 70 caracteres.',
                            ]),
                        Textarea::make('twitter_description')
                            ->label('Descripción Twitter')
                            ->placeholder('Descripción para Twitter (max 200 caracteres)')
                            ->rows(2)
                            ->maxLength(200)
                            ->validationMessages([
                                'max' => 'La descripción no puede exceder 200 caracteres.',
                            ]),
                        FileUpload::make('twitter_image')
                            ->label('Imagen Twitter')
                            ->disk('public')
                            ->image()
                            ->helperText('Imagen recomendada: 1200x675px'),
                    ]),
            ]);
    }
}