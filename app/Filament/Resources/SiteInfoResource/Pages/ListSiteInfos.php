<?php

namespace App\Filament\Resources\SiteInfoResource\Pages;

use App\Filament\Resources\SiteInfoResource\SiteInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiteInfos extends ListRecords
{
    protected static string $resource = SiteInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
