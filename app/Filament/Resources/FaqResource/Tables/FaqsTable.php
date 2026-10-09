<?php

namespace App\Filament\Resources\FaqResource\Tables;

use App\Models\Faq;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->label('Pregunta')->searchable()->wrap()->limit(80),
                TextColumn::make('page')->label('Página')->badge()->formatStateUsing(fn ($state) => Faq::PAGES[$state] ?? $state),
                TextColumn::make('order')->label('Orden')->sortable(),
                ToggleColumn::make('is_active')->label('Visible'),
            ])
            ->filters([SelectFilter::make('page')->label('Página')->options(Faq::PAGES)])
            ->defaultSort('order')
            ->reorderable('order')
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
