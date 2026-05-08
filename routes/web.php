<?php

use App\Livewire\Pages\Home;
use App\Livewire\Pages\Servicios;
use App\Livewire\Pages\Planes;
use App\Livewire\Pages\Obituario;
use App\Livewire\Pages\ObituarioDetalle;
use App\Livewire\Pages\ContactoPagina;
use App\Livewire\Pages\Testimonios;
use App\Livewire\Pages\Articulos;
use App\Livewire\Pages\AvisoPrivacidad;
use App\Livewire\Components\Navigation;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/nosotros', Home::class)->name('nosotros');
Route::get('/servicios', Servicios::class)->name('servicios');
Route::get('/planes', Planes::class)->name('planes');
Route::get('/obituario', Obituario::class)->name('obituario');
Route::get('/obituario/{id}', ObituarioDetalle::class)->name('obituario-detalle');
Route::get('/contacto', ContactoPagina::class)->name('contacto');
Route::get('/testimonios', Testimonios::class)->name('testimonios');
Route::get('/guia', Articulos::class)->name('guia');
Route::get('/aviso-de-privacidad', AvisoPrivacidad::class)->name('aviso-privacidad');