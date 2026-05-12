<?php

namespace App\Filament\Widgets;

use App\Models\QrCode;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;

class ActiveQRCodesWidget extends BaseWidget
{
    protected static ?int $sort = 10;

    protected static ?string $heading = 'Códigos QR Activos para Testimonios';

    protected int | string $columns = 4;

    protected function getTableHeight(): ?string
    {
        return '200px';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(QrCode::query()->where('is_active', true)->orderByDesc('id'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->editable(),
                Tables\Columns\TextColumn::make('url')->label('URL')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Creado')->date('d/m/Y'),
                Tables\Columns\IconColumn::make('is_active')->label('Activo')->boolean(),
            ]);
    }
}