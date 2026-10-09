<?php

namespace App\Filament\Resources\FaqResource\Schemas;

use App\Models\Faq;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('page')->label('Se muestra en')->options(Faq::PAGES)->required()->default('home'),
            TextInput::make('order')->label('Orden')->numeric()->default(0)->helperText('Menor número = aparece primero.'),
            TextInput::make('question')->label('Pregunta')->required()->maxLength(255)->columnSpanFull(),
            Textarea::make('answer')->label('Respuesta')->required()->rows(5)->maxLength(1500)->columnSpanFull(),
            Toggle::make('is_active')->label('Visible')->default(true),
        ]);
    }
}
