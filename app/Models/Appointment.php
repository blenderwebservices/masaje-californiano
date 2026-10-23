<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'spa_service_id',
        'client_name',
        'client_email',
        'client_phone',
        'appointment_date',
        'time_slot',
        'zone',
        'full_address',
        'status',
        'client_notes',
        'therapist_notes',
        'reminder_sent',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'reminder_sent' => 'boolean',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function spaService(): BelongsTo
    {
        return $this->belongsTo(SpaService::class);
    }

    public function getZoneLabelAttribute(): string
    {
        return match ($this->zone) {
            'cdmx' => 'Ciudad de México',
            'edomex' => 'Estado de México',
            'playa_del_carmen' => 'Playa del Carmen / Riviera Maya',
            default => 'Otra zona',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pendiente' => 'Pendiente de Confirmación',
            'confirmada' => 'Confirmada',
            'en_camino' => 'Terapeuta en Camino',
            'completada' => 'Sesión Completada',
            'cancelada' => 'Cancelada',
            default => ucfirst($this->status),
        };
    }

    public function getWhatsAppLinkAttribute(): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $this->client_phone);
        if (!str_starts_with($cleanPhone, '52') && strlen($cleanPhone) === 10) {
            $cleanPhone = '52' . $cleanPhone;
        }

        $serviceName = $this->spaService?->name ?? 'Masaje Californiano';
        $formattedDate = $this->appointment_date ? $this->appointment_date->format('d/m/Y') : '';
        $text = "Hola {$this->client_name}, te saluda Jesús Arturo Robles de Masaje Californiano a Domicilio. Te contacto con respecto a tu cita para {$serviceName} el día {$formattedDate} a las {$this->time_slot}. ¿Cómo te encuentras?";

        return "https://wa.me/{$cleanPhone}?text=" . urlencode($text);
    }
}
