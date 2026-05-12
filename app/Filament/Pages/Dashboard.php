<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\ObituariesChartWidget;
use App\Filament\Widgets\PageVisitsChartWidget;
use App\Filament\Widgets\RecentObituariesWidget;
use App\Filament\Widgets\RecentTestimonialsWidget;
use App\Filament\Widgets\RecentPageViewsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static ?string $slug = 'estadisticas';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';
    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static string | \UnitEnum | null $navigationGroup = 'Configuración del Sitio';
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = -1;

    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            ObituariesChartWidget::class,
            PageVisitsChartWidget::class,
            RecentObituariesWidget::class,
            RecentTestimonialsWidget::class,
            RecentPageViewsWidget::class,
        ];
    }
}