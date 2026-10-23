<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
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
            ->brandName('Masaje Californiano | Portal Terapeuta')
            ->brandLogo(asset('images/logo-californiano.jpeg'))
            ->brandLogoHeight('2.8rem')
            ->favicon(asset('images/logo-californiano.jpeg'))
            ->colors([
                'primary' => [
                    50 => '#f4f6f2',
                    100 => '#e6ece1',
                    200 => '#cfdbc7',
                    300 => '#adc3a1',
                    400 => '#85a476',
                    500 => '#4a5d43', // Verde oliva característico
                    600 => '#3d4d37',
                    700 => '#323f2d',
                    800 => '#293325',
                    900 => '#232b20',
                    950 => '#111710',
                ],
                'gold' => Color::Amber,
            ])
            ->navigationItems([
                NavigationItem::make('Ir a Sitio Web')
                    ->url('/', shouldOpenInNewTab: false)
                    ->icon('heroicon-o-globe-alt')
                    ->group('Acceso Rápido')
                    ->sort(99),
            ])
            ->navigationGroups([
                'Citas y Clientes',
                'Disponibilidad y Zonas',
                'Servicios de Spa',
                'Asistente Virtual RAG',
                'Contenido y Blog',
                'Configuración',
                'Acceso Rápido',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverviewWidget::class,
                Widgets\AccountWidget::class,
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
