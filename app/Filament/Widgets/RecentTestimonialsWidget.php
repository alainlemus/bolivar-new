<?php

namespace App\Filament\Widgets;

use App\Models\Testimonial;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;

class RecentTestimonialsWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Últimos Testimonios';

    protected int | string $columns = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(Testimonial::query()->orderByDesc('id')->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('rating')->label('★'),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Estado')
                    ->state(fn ($record) => $record->is_active ? 'Activo' : 'Pendiente'),
            ])
            ->actions([
                Action::make('ver')
                    ->label('Ver')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Testimonial $record): string => "/admin/testimonial-resource/testimonials/{$record->id}/edit")
            ]);
    }
}