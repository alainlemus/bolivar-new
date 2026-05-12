<?php

namespace App\Models;

use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'type',
        'slug',
        'label',
        'ip_address',
        'user_agent',
        'country',
        'country_code',
        'city',
    ];

    public static function record(string $type, ?string $slug = null, ?string $label = null): void
    {
        $ip = request()->ip();

        $location = null;
        try {
            $location = GeoIP::getLocation($ip);
        } catch (\Exception $e) {
            // GeoIP failed, continue without location
        }

        static::create([
            'type' => $type,
            'slug' => $slug,
            'label' => $label,
            'ip_address' => $ip ?? '',
            'user_agent' => substr(request()->userAgent() ?? '', 0, 255),
            'country' => $location['country'] ?? null,
            'country_code' => $location['iso_code'] ?? null,
            'city' => $location['city'] ?? null,
        ]);
    }

    public static function getStats(): array
    {
        $total = static::count();
        $today = static::whereDate('created_at', today())->count();
        $thisWeek = static::where('created_at', '>=', now()->startOfWeek())->count();
        $thisMonth = static::where('created_at', '>=', now()->startOfMonth())->count();

        $byCountry = static::selectRaw('country, country_code, COUNT(*) as count')
            ->whereNotNull('country')
            ->groupBy('country', 'country_code')
            ->orderByDesc('count')
            ->limit(20)
            ->get();

        $byPage = static::selectRaw('type, slug, label, COUNT(*) as count')
            ->groupBy('type', 'slug', 'label')
            ->orderByDesc('count')
            ->limit(20)
            ->get();

        $recentViews = static::orderByDesc('id')->limit(50)->get();

        return [
            'total' => $total,
            'today' => $today,
            'this_week' => $thisWeek,
            'this_month' => $thisMonth,
            'by_country' => $byCountry,
            'by_page' => $byPage,
            'recent_views' => $recentViews,
        ];
    }
}