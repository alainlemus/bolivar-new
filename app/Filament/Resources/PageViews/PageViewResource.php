<?php

namespace App\Filament\Resources\PageViews;

use App\Filament\Resources\PageViews\Pages\CreatePageView;
use App\Filament\Resources\PageViews\Pages\EditPageView;
use App\Filament\Resources\PageViews\Pages\ListPageViews;
use App\Filament\Resources\PageViews\Schemas\PageViewForm;
use App\Filament\Resources\PageViews\Tables\PageViewsTable;
use App\Models\PageView;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageViewResource extends Resource
{
    protected static ?string $model = PageView::class;

    protected static ?string $modelLabel = 'Visita';
    protected static ?string $pluralModelLabel = 'Visitas de Página';
    protected static ?string $navigationLabel = 'Visitas';
    protected static string|UnitEnum|null $navigationGroup = 'Configuración del Sitio';
    protected static ?int $navigationSort = 99;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'ip_address';
    protected static int $globalSearchResultsLimit = 10;

    public static function form(Schema $schema): Schema
    {
        return PageViewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageViewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageViews::route('/'),
            'create' => CreatePageView::route('/create'),
            'edit' => EditPageView::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['ip_address', 'label', 'country'];
    }
}