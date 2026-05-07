<?php

namespace App\Filament\Resources\SiteInfoResource;

use App\Filament\Resources\SiteInfoResource\Pages\CreateSiteInfo;
use App\Filament\Resources\SiteInfoResource\Pages\EditSiteInfo;
use App\Filament\Resources\SiteInfoResource\Pages\ListSiteInfos;
use App\Filament\Resources\SiteInfoResource\Schemas\SiteInfoForm;
use App\Filament\Resources\SiteInfoResource\Tables\SiteInfosTable;
use App\Models\SiteInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteInfoResource extends Resource
{
    protected static ?string $model = SiteInfo::class;

    protected static ?string $modelLabel = 'Información del Sitio';
    protected static ?string $pluralModelLabel = 'Información del Sitio';
    protected static ?string $navigationLabel = 'Configuración';
    protected static ?int $navigationSort = 1;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog;

    public static function form(Schema $schema): Schema
    {
        return SiteInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteInfosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiteInfos::route('/'),
            'create' => CreateSiteInfo::route('/create'),
            'edit' => EditSiteInfo::route('/{record}/edit'),
        ];
    }
}