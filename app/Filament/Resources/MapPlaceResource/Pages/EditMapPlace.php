<?php

namespace App\Filament\Resources\MapPlaceResource\Pages;

use App\Filament\Resources\MapPlaceResource\MapPlaceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMapPlace extends EditRecord
{
    protected static string $resource = MapPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
