<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['page', 'question', 'answer', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'order' => 'integer'];

    public const PAGES = [
        'home' => 'Inicio',
        'planes' => 'Planes',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Preguntas de una página en formato ['q' => ..., 'a' => ...] para el componente <x-faq>. */
    public static function forPage(string $page): array
    {
        return static::active()->where('page', $page)->orderBy('order')->orderBy('id')
            ->get(['question', 'answer'])
            // Con los planes ocultos (config/site.php) tampoco se muestran las preguntas que los mencionan.
            ->reject(fn ($f) => ! config('site.plans_enabled') && preg_match('/\bplanes?\b/iu', $f->question.' '.$f->answer))
            ->map(fn ($f) => ['q' => $f->question, 'a' => $f->answer])
            ->all();
    }
}
