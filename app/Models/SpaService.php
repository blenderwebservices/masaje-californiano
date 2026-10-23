<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SpaService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'duration_minutes',
        'short_description',
        'description',
        'benefits',
        'includes',
        'recommended_for',
        'image_url',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'benefits' => 'array',
        'includes' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'duration_minutes' => 'integer',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'masaje_californiano' => 'Masaje Californiano',
            'faciales' => 'Tratamientos Faciales',
            'terapias_holisticas' => 'Terapias Holísticas',
            'rituales' => 'Rituales Signature',
            default => ucfirst(str_replace('_', ' ', $this->category)),
        };
    }
}
