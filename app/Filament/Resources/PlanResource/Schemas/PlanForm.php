<?php

namespace App\Filament\Resources\PlanResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required('El nombre es obligatorio.')
                    ->placeholder('Nombre del plan')
                    ->maxLength(100),
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción del plan')
                    ->columnSpanFull()
                    ->maxLength(500),
                TextInput::make('price')
                    ->label('Precio (MXN)')
                    ->required('El precio es obligatorio.')
                    ->numeric('El precio debe ser un número.')
                    ->placeholder('0.00')
                    ->minValue(0),
                Select::make('emblem')
                    ->label('Emblema')
                    ->options([
                        'vela' => 'Vela (calidez esencial)',
                        'olivo' => 'Corona de olivo (paz y protección)',
                        'loto' => 'Flor de loto (trascendencia)',
                    ])
                    ->placeholder('Automático según el nombre')
                    ->helperText('Ilustración que identifica al plan en el sitio. Vacío = se elige solo ("Básico" → vela, "Completo" → olivo, "Premium" → loto).'),
                Textarea::make('features')
                    ->label('Características')
                    ->rows(8)
                    ->columnSpanFull()
                    ->placeholder("Atención 24/7\nAsesoría personalizada\nTraslado local")
                    ->helperText('Escribe una característica por línea. Se muestran como lista y en la tabla comparativa.')
                    ->formatStateUsing(function ($state) {
                        $list = is_string($state) ? json_decode($state, true) : $state;

                        return is_array($list) ? implode("\n", $list) : (string) $state;
                    })
                    ->dehydrateStateUsing(fn ($state) => json_encode(
                        array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $state)))),
                        JSON_UNESCAPED_UNICODE
                    )),
                TextInput::make('order')
                    ->label('Orden')
                    ->required('El orden es obligatorio.')
                    ->numeric('El orden debe ser un número.')
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}
