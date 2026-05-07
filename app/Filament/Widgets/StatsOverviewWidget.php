<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slide;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $visitasHoy = PageView::whereDate('created_at', today())->count();
        $visitasSemana = PageView::where('created_at', '>=', now()->subDays(7))->count();
        $visitasTotal = PageView::count();

        $totalSlides = Slide::count();
        $activeSlides = Slide::where('is_active', true)->count();

        $totalServices = Service::count();
        $activeServices = Service::where('is_active', true)->count();

        $settingsCount = Setting::count();

        return [
            Stat::make('Visitas hoy', $visitasHoy)
                ->description("Esta semana: {$visitasSemana} | Total: {$visitasTotal}")
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),

            Stat::make('Slides activos', "{$activeSlides}/{$totalSlides}")
                ->description('Imágenes del carousel')
                ->descriptionIcon('heroicon-m-photo')
                ->color('success'),

            Stat::make('Servicios activos', "{$activeServices}/{$totalServices}")
                ->description('Servicios y beneficios')
                ->descriptionIcon('heroicon-m-cog')
                ->color('warning'),

            Stat::make('Configuraciones', $settingsCount)
                ->description('Ajustes del sitio')
                ->descriptionIcon('heroicon-m-adjustments-horizontal')
                ->color('gray'),
        ];
    }
}