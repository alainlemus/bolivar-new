<?php

namespace App\Filament\Resources\QrCodes;

use App\Filament\Resources\QrCodes\Pages\CreateQrCode;
use App\Filament\Resources\QrCodes\Pages\EditQrCode;
use App\Filament\Resources\QrCodes\Pages\ListQrCodes;
use App\Filament\Resources\QrCodes\Schemas\QrCodeForm;
use App\Filament\Resources\QrCodes\Tables\QrCodesTable;
use App\Models\QrCode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class QrCodeResource extends Resource
{
    protected static ?string $model = QrCode::class;

    protected static ?string $modelLabel = 'Código QR';
    protected static ?string $pluralModelLabel = 'Códigos QR';
    protected static ?string $navigationLabel = 'Códigos QR';
    protected static string|UnitEnum|null $navigationGroup = 'Configuración del Sitio';
    protected static ?int $navigationSort = 98;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQrCode;
    protected static ?string $recordTitleAttribute = 'name';
    protected static int $globalSearchResultsLimit = 10;

    public static function form(Schema $schema): Schema
    {
        return QrCodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QrCodesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQrCodes::route('/'),
            'create' => CreateQrCode::route('/create'),
            'edit' => EditQrCode::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'url'];
    }
}