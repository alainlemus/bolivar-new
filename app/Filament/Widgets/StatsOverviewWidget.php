<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Contacts\ContactResource;
use App\Filament\Resources\TestimonialResource\TestimonialResource;
use App\Models\Contact;
use App\Models\MapPlace;
use App\Models\Obituary;
use App\Models\PageView;
use App\Models\Testimonial;
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
        $mensajesPendientes = Contact::where('status', 'pending')->count();
        $lugaresMapa = MapPlace::active()->count();
        $obituariesActivos = Obituary::active()->count();

        return [
            Stat::make('Visitas de Hoy', $visitasHoy)
                ->description("Total histórico: {$visitasTotal}")
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),

            Stat::make('Testimonios por aprobar', $testimoniosPendientes)
                ->description("{$testimoniosTotal} en total · Calificación {$ratingPromedio} ⭐")
                ->descriptionIcon('heroicon-m-star')
                ->color($testimoniosPendientes > 0 ? 'warning' : 'success')
                ->url(TestimonialResource::getUrl('index', ['filters' => ['is_active' => ['value' => '0']]])),

            Stat::make('Mensajes por atender', $mensajesPendientes)
                ->description('del formulario de contacto')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($mensajesPendientes > 0 ? 'danger' : 'success')
                ->url(ContactResource::getUrl('index')),

            Stat::make('Obituarios Activos', $obituariesActivos)
                ->description("publicados ahora · {$lugaresMapa} lugares en el mapa")
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('success'),
        ];
    }
}
