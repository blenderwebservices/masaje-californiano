<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'spa_service_id',
        'preferred_date',
        'preferred_time_slot',
        'zone',
        'address',
        'client_notes',
        'status',
        'source',
        'internal_notes',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];

    public function spaService(): BelongsTo
    {
        return $this->belongsTo(SpaService::class);
    }

    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class);
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
            'nuevo' => 'Nuevo Lead',
            'contactado' => 'Contactado',
            'cita_agendada' => 'Cita Agendada',
            'descartado' => 'Descartado',
            default => ucfirst($this->status),
        };
    }
}
