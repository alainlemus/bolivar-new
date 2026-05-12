<?php

namespace App\Filament\Widgets;

use App\Models\Obituary;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;

class RecentObituariesWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Últimos Obituarios';

    protected int | string $columns = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(Obituary::query()->orderByDesc('id')->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('deceased_name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('chapel')->label('Capilla'),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha')->date('d/m'),
            ])
            ->actions([
                Action::make('ver')
                    ->label('Ver')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Obituary $record): string => "/admin/obituary-resource/obituaries/{$record->slug}/edit")
            ]);
    }
}