<?php

namespace App\Filament\Resources\PageViews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Table;

class PageViewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')->label('IP')->searchable(),
                Tables\Columns\TextColumn::make('label')->label('Página')->searchable(),
                Tables\Columns\TextColumn::make('country')->label('País')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha')->date('d/m/Y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
