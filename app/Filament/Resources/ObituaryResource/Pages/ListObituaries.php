<?php

namespace App\Filament\Resources\ObituaryResource\Pages;

use App\Filament\Resources\ObituaryResource\ObituaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListObituaries extends ListRecords
{
    protected static string $resource = ObituaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}