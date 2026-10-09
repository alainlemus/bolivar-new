<?php

namespace App\Support;

use Filament\Forms\Components\BaseFileUpload;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Convierte a WebP y comprime las imágenes que se suben desde el panel.
 *
 * - Redimensiona (lado mayor ≤ 2000 px) sin ampliar.
 * - Respeta la orientación EXIF y la transparencia de PNG/WebP.
 * - Elimina metadatos (ubicación GPS, cámara, etc.).
 * - SVG, GIF animados, videos y demás archivos se guardan tal cual.
 */
class ImageOptimizer
{
    public const MAX_SIDE = 2000;

    public const QUALITY = 80;

    private const CONVERTIBLE = ['image/jpeg', 'image/png', 'image/webp', 'image/bmp', 'image/x-ms-bmp'];

    /** Guarda el archivo subido por un FileUpload de Filament (convertido si es una imagen). */
    public static function store(BaseFileUpload $component, TemporaryUploadedFile $file): ?string
    {
        // Íconos (favicon) y otros campos que necesitan su formato original
        if ($component->getName() === 'favicon' || ! self::canConvert($file->getMimeType())) {
            return $component->saveUploadedFile($file);
        }

        $webp = self::toWebp($file->getRealPath());

        if ($webp === null) {
            return $component->saveUploadedFile($file);
        }

        $path = trim($component->getDirectory().'/'.Str::ulid().'.webp', '/');
        $component->getDisk()->put($path, $webp, ['visibility' => $component->getVisibility()]);
        $file->delete();

        return $path;
    }

    public static function canConvert(?string $mime): bool
    {
        return function_exists('imagewebp') && in_array($mime, self::CONVERTIBLE, true);
    }

    /** Devuelve el binario WebP optimizado, o null si no se pudo procesar. */
    public static function toWebp(string $path, int $maxSide = self::MAX_SIDE, int $quality = self::QUALITY): ?string
    {
        $data = @file_get_contents($path);
        $image = $data ? @imagecreatefromstring($data) : false;

        if (! $image) {
            return null;
        }

        // Orientación (fotos de celular)
        if (function_exists('exif_read_data') && str_starts_with((string) @mime_content_type($path), 'image/jpeg')) {
            $orientation = @exif_read_data($path)['Orientation'] ?? 1;
            $rotated = match ((int) $orientation) {
                3 => imagerotate($image, 180, 0),
                6 => imagerotate($image, -90, 0),
                8 => imagerotate($image, 90, 0),
                default => null,
            };
            if ($rotated) {
                imagedestroy($image);
                $image = $rotated;
            }
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        [$w, $h] = [imagesx($image), imagesy($image)];
        $scale = min(1, $maxSide / max($w, $h));

        if ($scale < 1) {
            $resized = imagescale($image, (int) round($w * $scale), (int) round($h * $scale), IMG_BICUBIC);
            if ($resized) {
                imagedestroy($image);
                $image = $resized;
                imagesavealpha($image, true);
            }
        }

        ob_start();
        $ok = imagewebp($image, null, $quality);
        $binary = ob_get_clean();
        imagedestroy($image);

        if (! $ok || ! $binary) {
            return null;
        }

        // Si el original ya era más liviano, no tiene caso convertirlo
        return strlen($binary) < strlen($data) || $scale < 1 || ! str_contains((string) @mime_content_type($path), 'webp') ? $binary : null;
    }
}
