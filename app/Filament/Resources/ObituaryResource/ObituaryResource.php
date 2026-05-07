<?php

namespace App\Filament\Resources\ObituaryResource;

use App\Filament\Resources\ObituaryResource\Pages\CreateObituary;
use App\Filament\Resources\ObituaryResource\Pages\EditObituary;
use App\Filament\Resources\ObituaryResource\Pages\ListObituaries;
use App\Filament\Resources\ObituaryResource\Schemas\ObituaryForm;
use App\Filament\Resources\ObituaryResource\Tables\ObituariesTable;
use App\Models\Obituary;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ObituaryResource extends Resource
{
    protected static ?string $model = Obituary::class;

    protected static ?string $modelLabel = 'Obituario';
    protected static ?string $pluralModelLabel = 'Obituarios';
    protected static ?string $navigationLabel = 'Obituarios';
    protected static string|UnitEnum|null $navigationGroup = 'Secciones';
    protected static ?int $navigationSort = 4;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    public static function form(Schema $schema): Schema
    {
        return ObituaryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ObituariesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListObituaries::route('/'),
            'create' => CreateObituary::route('/create'),
            'edit' => EditObituary::route('/{record}/edit'),
        ];
    }
}