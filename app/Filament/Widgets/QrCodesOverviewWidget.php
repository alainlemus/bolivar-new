<?php

namespace App\Filament\Widgets;

use App\Models\QrCode;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QrCodesOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 100;

    protected function getStats(): array
    {
        $activeCount = QrCode::where('is_active', true)->count();
        $totalCount = QrCode::count();

        return [
            Stat::make('QRs Activos', $activeCount)
                ->description('Códigos QR activos')
                ->descriptionIcon('heroicon-m-qr-code')
                ->color('success'),
            Stat::make('Total Creados', $totalCount)
                ->description('Historial de códigos QR')
                ->descriptionIcon('heroicon-m-list-bullet')
                ->color('gray'),
        ];
    }
}