<?php

namespace App\Filament\Resources\ObituaryResource\Tables;

use App\Filament\Resources\ObituaryResource\ObituaryResource;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ObituariesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('deceased_name')
                    ->label('Nombre del Fallecido')
                    ->searchable(),
                TextColumn::make('date_of_death')
                    ->label('Fecha de Fallecimiento')
                    ->dateTime('d/m/Y'),
                TextColumn::make('age')
                    ->label('Edad')
                    ->numeric(),
                TextColumn::make('burial_date')
                    ->label('Servicio')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('chapel')
                    ->label('Capilla')
                    ->toggleable(),
                TextColumn::make('responsible_name')
                    ->label('Responsable')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('candles')
                    ->label('Velas')
                    ->icon('heroicon-o-fire')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                TextColumn::make('vigencia')
                    ->label('Publicación')
                    ->badge()
                    ->state(fn ($record) => ! $record->is_active ? 'Oculto'
                        : ($record->start_date && $record->start_date->isFuture() ? 'Programado'
                        : ($record->end_date && $record->end_date->isPast() ? 'Vencido' : 'Publicado')))
                    ->color(fn (string $state) => match ($state) {
                        'Publicado' => 'success', 'Programado' => 'info', 'Vencido' => 'gray', default => 'warning',
                    }),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('publicados')
                    ->label('Publicados ahora')
                    ->query(fn (Builder $query) => $query->active()),
            ])
            ->recordActions([
                Action::make('vista_previa')
                    ->label('Vista previa')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn ($record) => ObituaryResource::previewUrl($record), shouldOpenInNewTab: true),
                Action::make('ver')
                    ->label('Ver en el sitio')
                    ->visible(fn ($record) => $record->is_active)
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn ($record) => route('obituario-detalle', $record->slug), shouldOpenInNewTab: true),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
