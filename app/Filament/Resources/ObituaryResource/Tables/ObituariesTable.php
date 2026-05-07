<?php

namespace App\Filament\Resources\ObituaryResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ObituariesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagen'),
                TextColumn::make('deceased_name')
                    ->label('Nombre del Fallecido')
                    ->searchable(),
                TextColumn::make('date_of_death')
                    ->label('Fecha de Fallecimiento')
                    ->dateTime('d/m/Y'),
                TextColumn::make('age')
                    ->label('Edad')
                    ->numeric(),
                TextColumn::make('relationship')
                    ->label('Parentesco'),
                TextColumn::make('responsible_name')
                    ->label('Responsable'),
                TextColumn::make('chapel')
                    ->label('Capilla'),
                TextColumn::make('cemetery')
                    ->label('Cementerio'),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
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
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}