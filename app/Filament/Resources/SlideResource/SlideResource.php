<?php

namespace App\Filament\Resources\SlideResource;

use App\Filament\Resources\SlideResource\Pages\CreateSlide;
use App\Filament\Resources\SlideResource\Pages\EditSlide;
use App\Filament\Resources\SlideResource\Pages\ListSlides;
use App\Filament\Resources\SlideResource\Schemas\SlideForm;
use App\Filament\Resources\SlideResource\Tables\SlidesTable;
use App\Models\Slide;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $modelLabel = 'Diapositiva';
    protected static ?string $pluralModelLabel = 'Diapositivas';
    protected static ?string $navigationLabel = 'Diapositivas';
    protected static string|UnitEnum|null $navigationGroup = 'Secciones';
    protected static ?int $navigationSort = 3;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'title';
    protected static int $globalSearchResultsLimit = 10;

    public static function form(Schema $schema): Schema
    {
        return SlideForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SlidesTable::configure($table);
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
            'index' => ListSlides::route('/'),
            'create' => CreateSlide::route('/create'),
            'edit' => EditSlide::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'subtitle'];
    }
}