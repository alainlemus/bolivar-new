<?php

namespace App\Filament\Resources\PlanResource;

use App\Filament\Resources\PlanResource\Pages\CreatePlan;
use App\Filament\Resources\PlanResource\Pages\EditPlan;
use App\Filament\Resources\PlanResource\Pages\ListPlans;
use App\Filament\Resources\PlanResource\Schemas\PlanForm;
use App\Filament\Resources\PlanResource\Tables\PlansTable;
use App\Models\Plan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $modelLabel = 'Plan';
    protected static ?string $pluralModelLabel = 'Planes';
    protected static ?string $navigationLabel = 'Planes';
    protected static ?int $navigationSort = 5;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    public static function form(Schema $schema): Schema
    {
        return PlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlans::route('/'),
            'create' => CreatePlan::route('/create'),
            'edit' => EditPlan::route('/{record}/edit'),
        ];
    }
}