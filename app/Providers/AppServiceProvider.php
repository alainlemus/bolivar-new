<?php

namespace App\Providers;

use App\Models\SiteInfo;
use App\Support\ImageOptimizer;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Toda imagen subida desde el panel se convierte a WebP y se comprime
        FileUpload::configureUsing(function (FileUpload $component): void {
            $component->saveUploadedFileUsing(fn (BaseFileUpload $c, TemporaryUploadedFile $file) => ImageOptimizer::store($c, $file));
        });

        View::composer('*', function ($view) {
            $view->with('siteInfo', SiteInfo::getSiteInfo());
        });
    }
}
