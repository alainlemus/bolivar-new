<?php

use App\Livewire\Pages\Home;
use App\Livewire\Pages\Servicios;
use App\Livewire\Pages\Planes;
use App\Livewire\Pages\Obituario;
use App\Livewire\Pages\ObituarioDetalle;
use App\Livewire\Pages\ContactoPagina;
use App\Livewire\Pages\Testimonios;
use App\Livewire\Pages\TestimonioForm;
use App\Livewire\Pages\Articulos;
use App\Livewire\Pages\ArticuloDetalle;
use App\Livewire\Pages\AvisoPrivacidad;
use App\Livewire\Components\Navigation;
use Illuminate\Support\Facades\Route;

Route::middleware(['track.page.views'])->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/nosotros', Home::class)->name('nosotros');
    Route::get('/servicios', Servicios::class)->name('servicios');
    Route::get('/planes', Planes::class)->name('planes');
    Route::get('/obituario', Obituario::class)->name('obituario');
    Route::get('/obituario/{slug}', ObituarioDetalle::class)->name('obituario-detalle');
    Route::get('/contacto', ContactoPagina::class)->name('contacto');
    Route::get('/testimonios', Testimonios::class)->name('testimonios');
    Route::get('/testimonios/formulario', TestimonioForm::class)->name('testimonios-form');
    Route::get('/testimonios/{slug}', TestimonioForm::class)->name('testimonios-qr');
    Route::get('/guia', Articulos::class)->name('guia');
    Route::get('/guia/{slug}', ArticuloDetalle::class)->name('guia-detalle');
    Route::get('/aviso-de-privacidad', AvisoPrivacidad::class)->name('aviso-privacidad');
});