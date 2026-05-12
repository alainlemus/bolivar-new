<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;

class PageVisitsChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;
    protected ?string $maxHeight = '200px';

    public function getHeading(): string
    {
        return 'Visitas por Página del Año';
    }

    protected function getData(): array
    {
        $months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $year = now()->year;

        $pageTypes = ['home', 'services', 'about', 'contact', 'obituary', 'testimonials', 'articles', 'plans'];
        $pageLabels = ['Inicio', 'Servicios', 'Nosotros', 'Contacto', 'Obituario', 'Testimonios', 'Guía', 'Planes'];

        $datasets = [];
        foreach ($pageTypes as $index => $type) {
            $monthlyData = [];
            for ($i = 1; $i <= 12; $i++) {
                $count = PageView::selectRaw('COUNT(*) as count')
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $i)
                    ->where('type', $type)
                    ->count();
                $monthlyData[] = $count;
            }

            $colors = ['#f59e0b', '#3b82f6', '#10b981', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4', '#84cc16'];

            $datasets[] = [
                'label' => $pageLabels[$index],
                'data' => $monthlyData,
                'borderColor' => $colors[$index],
                'backgroundColor' => 'transparent',
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}