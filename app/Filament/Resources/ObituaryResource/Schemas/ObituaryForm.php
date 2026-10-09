<?php

namespace App\Filament\Resources\ObituaryResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                    ->required('El nombre es obligatorio.')
                    ->placeholder('Nombre completo')
                    ->maxLength(200),
                DatePicker::make('date_of_birth')
                    ->label('Fecha de Nacimiento')
                    ->helperText('Opcional. Se muestra en el obituario junto al año de fallecimiento.'),
                DateTimePicker::make('date_of_death')
                    ->label('Fecha de Fallecimiento')
                    ->required('La fecha de fallecimiento es obligatoria.'),
                TextInput::make('age')
                    ->label('Edad')
                    ->numeric('La edad debe ser un número.')
                    ->placeholder('Edad')
                    ->minValue(0)
                    ->maxValue(150),
                TextInput::make('chapel')
                    ->label('Capilla o lugar de velación')
                    ->placeholder('Capilla o lugar')
                    ->maxLength(200),
                TextInput::make('cemetery')
                    ->label('Panteón o cementerio')
                    ->placeholder('Lugar de último descanso')
                    ->maxLength(200),
                DateTimePicker::make('velatorio_start')
                    ->label('Fecha y Hora de Ingreso al Velatorio'),
                DateTimePicker::make('velatorio_end')
                    ->label('Fecha y Hora de Salida del Velatorio'),
                TextInput::make('departure_time')
                    ->label('Hora de Salida')
                    ->placeholder('Ej: 10:00')
                    ->maxLength(20),
                TextInput::make('destination')
                    ->label('Destino')
                    ->placeholder('Cementerio / Horno crematorio / Traslado a provincia')
                    ->maxLength(300),
                DateTimePicker::make('burial_date')
                    ->label('Fecha y Hora del Destino')
                    ->helperText('Fecha y hora de inhumación, cremación o traslado'),
                FileUpload::make('image')
                    ->label('Fotografía principal')
                    ->helperText('Retrato de la persona. Aparece en el obituario y al compartirlo en redes sociales.')
                    ->disk('public')
                    ->directory('obituaries')
                    ->image()
                    ->imageEditor()
                    ->imageAspectRatio('4:5')
                    ->automaticallyCropImagesToAspectRatio()
                    ->maxSize(4096),
                FileUpload::make('gallery')
                    ->label('Galería de recuerdos')
                    ->helperText('Hasta 8 fotografías. Se pueden reordenar arrastrando.')
                    ->disk('public')
                    ->directory('obituaries')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(8)
                    ->maxSize(4096)
                    ->columnSpanFull(),
                Textarea::make('obituary_text')
                    ->label('Mensaje de la Familia')
                    ->helperText('Palabras de despedida. Se muestran como semblanza en la página del obituario.')
                    ->placeholder('Mensaje para el obituario…')
                    ->columnSpanFull()
                    ->rows(6)
                    ->maxLength(2000),
                TextInput::make('responsible_name')
                    ->label('Responsable (familiar)')
                    ->required('El nombre del responsable es obligatorio.')
                    ->helperText('Uso interno: no se publica en el sitio.')
                    ->maxLength(200),
                TextInput::make('responsible_phone')
                    ->label('Teléfono del responsable')
                    ->tel()
                    ->required('El teléfono del responsable es obligatorio.')
                    ->helperText('Uso interno: no se publica en el sitio.')
                    ->maxLength(30),
                TextInput::make('responsible_email')
                    ->label('Correo del responsable')
                    ->email()
                    ->maxLength(200),
                Select::make('relationship')
                    ->label('Parentesco del responsable')
                    ->helperText('Se usa en la despedida: «Con todo nuestro amor, su hija y toda su familia».')
                    ->options(array_combine(
                        ['Esposa', 'Esposo', 'Hija', 'Hijo', 'Madre', 'Padre', 'Hermana', 'Hermano', 'Nieta', 'Nieto', 'Sobrina', 'Sobrino', 'Amiga', 'Amigo'],
                        ['Esposa', 'Esposo', 'Hija', 'Hijo', 'Madre', 'Padre', 'Hermana', 'Hermano', 'Nieta', 'Nieto', 'Sobrina', 'Sobrino', 'Amiga', 'Amigo']
                    ))
                    ->searchable(),
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
