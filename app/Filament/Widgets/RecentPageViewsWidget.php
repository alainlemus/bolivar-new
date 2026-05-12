<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;

class RecentPageViewsWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected static ?string $heading = 'Últimas Visitas';

    protected int | string $columns = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(PageView::query()->orderByDesc('id')->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')->label('IP')->searchable(),
                Tables\Columns\TextColumn::make('label')->label('Página')->searchable(),
                Tables\Columns\TextColumn::make('country')->label('País'),
            ])
            ->actions([
                Action::make('ver')
                    ->label('Ver')
                    ->icon('heroicon-m-eye')
                    ->url(fn (PageView $record): string => "/admin/page-views/{$record->id}/edit")
            ]);
    }
}