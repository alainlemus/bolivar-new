<?php

use App\Models\Obituary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /** Elimina los obituarios de prueba (responsible_name = 'EJEMPLO') al desplegar en producción. */
    public function up(): void
    {
        if (! app()->isProduction()) {
            return;
        }

        Obituary::where('responsible_name', 'EJEMPLO')->get()->each(function (Obituary $obituary) {
            $files = array_filter(array_merge([$obituary->image], (array) $obituary->gallery));
            foreach ($files as $file) {
                if (str_starts_with((string) $file, 'obituaries/ejemplo-')) {
                    Storage::disk('public')->delete($file);
                }
            }
            $obituary->delete();
        });
    }

    public function down(): void
    {
        // Irreversible: los datos de prueba no se restauran.
    }
};
