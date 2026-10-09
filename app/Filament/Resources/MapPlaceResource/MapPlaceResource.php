<?php

namespace App\Filament\Resources\MapPlaceResource;

use App\Filament\Resources\MapPlaceResource\Pages\CreateMapPlace;
use App\Filament\Resources\MapPlaceResource\Pages\EditMapPlace;
use App\Filament\Resources\MapPlaceResource\Pages\ListMapPlaces;
use App\Filament\Resources\MapPlaceResource\Schemas\MapPlaceForm;
use App\Filament\Resources\MapPlaceResource\Tables\MapPlacesTable;
use App\Models\MapPlace;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MapPlaceResource extends Resource
{
    protected static ?string $model = MapPlace::class;

    protected static ?string $modelLabel = 'Lugar del mapa';

    protected static ?string $pluralModelLabel = 'Mapa de panteones y crematorios';

    protected static ?string $navigationLabel = 'Mapa de panteones';

    protected static string|UnitEnum|null $navigationGroup = 'Secciones';

    protected static ?int $navigationSort = 8;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return MapPlaceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MapPlacesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMapPlaces::route('/'),
            'create' => CreateMapPlace::route('/create'),
            'edit' => EditMapPlace::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'address', 'alcaldia'];
    }
}
