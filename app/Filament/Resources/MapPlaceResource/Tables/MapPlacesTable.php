<?php

namespace App\Filament\Resources\MapPlaceResource\Tables;

use App\Models\MapPlace;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MapPlacesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable()->wrap(),
                TextColumn::make('type')->label('Tipo')->badge()->formatStateUsing(fn ($state) => MapPlace::TYPES[$state] ?? $state),
                TextColumn::make('alcaldia')->label('Alcaldía')->searchable()->sortable(),
                TextColumn::make('address')->label('Dirección')->limit(40)->toggleable(),
                TextColumn::make('source')->label('Fuente')->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')->label('Visible')->boolean(),
            ])
            ->filters([
                SelectFilter::make('type')->label('Tipo')->options(MapPlace::TYPES),
            ])
            ->defaultSort('name')
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
