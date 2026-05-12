<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Obituary;
use App\Models\Article;
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
        $visitasTotal = PageView::count();
        $testimoniosTotal = Testimonial::count();
        $testimoniosPendientes = Testimonial::where('is_active', false)->count();
        $ratingPromedio = round(Testimonial::avg('rating') ?? 0, 1);
        $serviciosTotal = Service::count();
        $obituariesActivos = Obituary::active()->count();

        return [
            Stat::make('Visitas de Hoy', $visitasHoy)
                ->description("Total histórico: {$visitasTotal}")
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),

            Stat::make('Testimonios', $testimoniosTotal)
                ->description("{$testimoniosPendientes} pendientes | Rating: {$ratingPromedio} ⭐")
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Servicios', $serviciosTotal)
                ->description('servicios disponibles')
                ->descriptionIcon('heroicon-m-cog')
                ->color('gray'),

            Stat::make('Obituarios Activos', $obituariesActivos)
                ->description('publicados actualmente')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('success'),
        ];
    }
}