<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->passwordReset()
            ->brandName(fn () => \App\Models\SiteInfo::getSiteInfo()->site_name ?? 'Funeraria García de Bolívar')
            ->brandLogo(fn () => once(function () {
                $siteInfo = \App\Models\SiteInfo::getSiteInfo();
                return $siteInfo->site_logo
                    ? asset('storage/' . $siteInfo->site_logo)
                    : asset('images/logo.png');
            }))
            ->brandLogoHeight('3rem')
            ->favicon(fn () => once(function () {
                $siteInfo = \App\Models\SiteInfo::getSiteInfo();
                return $siteInfo->favicon
                    ? asset('storage/' . $siteInfo->favicon)
                    : asset('favicon.ico');
            }))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigationGroups([
                NavigationGroup::make('Configuración del Sitio'),
                NavigationGroup::make('Secciones'),
                NavigationGroup::make(__('filament-shield::filament-shield.nav.group')),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                \App\Filament\Widgets\StatsOverviewWidget::class,
                \App\Filament\Widgets\ObituariesChartWidget::class,
                \App\Filament\Widgets\PageVisitsChartWidget::class,
                \App\Filament\Widgets\RecentObituariesWidget::class,
                \App\Filament\Widgets\RecentTestimonialsWidget::class,
                \App\Filament\Widgets\RecentPageViewsWidget::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->gridColumns(['default' => 1, 'sm' => 2, 'lg' => 3])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns(['default' => 1, 'sm' => 2, 'lg' => 4])
                    ->resourceCheckboxListColumns(['default' => 1, 'sm' => 2]),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}