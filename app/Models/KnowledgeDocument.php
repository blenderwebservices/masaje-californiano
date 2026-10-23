<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'content',
        'keywords',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'faq' => 'Preguntas Frecuentes (FAQ)',
            'tecnica_masaje' => 'Técnica de Masaje Californiano',
            'preparacion_domicilio' => 'Preparación para el Hogar',
            'zonas_cobertura' => 'Zonas y Cobertura a Domicilio',
            'terapeuta' => 'Sobre Jesús Arturo Robles',
            'beneficios' => 'Beneficios Terapéuticos y Físicos',
            default => ucfirst(str_replace('_', ' ', $this->category)),
        };
    }
}
