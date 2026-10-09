<?php

namespace App\Filament\Resources\MapPlaceResource\Pages;

use App\Filament\Resources\MapPlaceResource\MapPlaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMapPlaces extends ListRecords
{
    protected static string $resource = MapPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
