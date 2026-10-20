<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Contenido capturado desde el panel (planes, artículos, testimonios, slides y datos del sitio),
 * exportado a data/content.json junto con sus imágenes en data/images/uploads/.
 * Es idempotente: se puede correr en cualquier ambiente (php artisan db:seed --class=ContentSeeder --force).
 * Hace upsert por llave natural, así que sobreescribe lo editado a mano en esos registros.
 */
class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/content.json')), true);

        $this->copyUploads();

        foreach ($data['plans'] as $row) {
            $this->upsert('plans', ['name' => $row['name']], $row);
        }

        foreach ($data['slides'] as $row) {
            $this->upsert('slides', ['image' => $row['image']], $row);
        }

        foreach ($data['testimonials'] as $row) {
            $this->upsert('testimonials', ['name' => $row['name'], 'text' => $row['text']], $row);
        }

        foreach ($data['articles'] as $row) {
            $this->upsert('articles', ['slug' => $row['slug']], $row);
        }

        // Una sola fila de datos del sitio.
        $siteInfoId = DB::table('site_infos')->value('id');
        $siteInfoId
            ? DB::table('site_infos')->where('id', $siteInfoId)->update($data['site_info'] + ['updated_at' => now()])
            : DB::table('site_infos')->insert($data['site_info'] + ['created_at' => now(), 'updated_at' => now()]);

        $this->call([
            ArticleCoversSeeder::class,
            MapPlaceSeeder::class,
            FaqSeeder::class,
        ]);
    }

    private function copyUploads(): void
    {
        $base = database_path('seeders/data/images/uploads');

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($base, \FilesystemIterator::SKIP_DOTS)) as $file) {
            $path = ltrim(substr($file->getPathname(), strlen($base)), DIRECTORY_SEPARATOR);
            Storage::disk('public')->put($path, file_get_contents($file->getPathname()));
        }
    }

    private function upsert(string $table, array $match, array $values): void
    {
        $query = DB::table($table)->where($match);

        $query->exists()
            ? $query->update($values + ['updated_at' => now()])
            : DB::table($table)->insert($values + ['created_at' => now(), 'updated_at' => now()]);
    }
}
