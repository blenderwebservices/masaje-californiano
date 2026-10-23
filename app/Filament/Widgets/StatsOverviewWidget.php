<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Lead;
use App\Models\SpaService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $citasPendientes = Appointment::where('status', 'pendiente')->count();
        $citasConfirmadas = Appointment::whereIn('status', ['confirmada', 'en_camino'])
            ->where('appointment_date', '>=', now()->toDateString())
            ->count();
        $leadsNuevos = Lead::where('status', 'nuevo')->count();
        $serviciosActivos = SpaService::where('is_active', true)->count();

        return [
            Stat::make('Citas Pendientes', $citasPendientes)
                ->description('Por validar o confirmar con el cliente')
                ->descriptionIcon('heroicon-m-clock')
                ->color($citasPendientes > 0 ? 'warning' : 'gray'),

            Stat::make('Citas Próximas', $citasConfirmadas)
                ->description('En agenda activa a domicilio')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Nuevos Leads', $leadsNuevos)
                ->description('Contactos recibidos desde el sitio web')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color($leadsNuevos > 0 ? 'danger' : 'gray'),

            Stat::make('Servicios Activos', $serviciosActivos)
                ->description('Masajes californianos y faciales')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('primary'),
        ];
    }
}
