<?php

namespace App\Filament\Widgets;

use App\Models\Obituary;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ObituariesChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $maxHeight = '200px';

    public function getHeading(): string
    {
        return 'Obituarios del Año';
    }

    protected function getData(): array
    {
        $months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

        $year = now()->year;
        $monthlyCounts = Obituary::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyCounts[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Obituarios',
                    'data' => $data,
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}