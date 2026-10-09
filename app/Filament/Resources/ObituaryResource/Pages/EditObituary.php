<?php

namespace App\Filament\Resources\ObituaryResource\Pages;

use App\Filament\Resources\ObituaryResource\ObituaryResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditObituary extends EditRecord
{
    protected static string $resource = ObituaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('vista_previa')
                ->label('Vista previa')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->tooltip('Guarda los cambios y abre el obituario como lo verán las familias')
                ->action(function () {
                    $this->save(shouldRedirect: false, shouldSendSavedNotification: false);

                    $url = ObituaryResource::previewUrl($this->getRecord());
                    $this->js('window.open('.json_encode($url).", '_blank')");
                }),
            DeleteAction::make(),
        ];
    }
}
