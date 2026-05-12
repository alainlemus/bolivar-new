<?php

namespace App\Livewire\Pages;

use App\Models\Service;
use Livewire\Component;

class Servicios extends Component
{
    protected $seoTitle = 'Servicios Funerarios | Funeraria García de Bolívar';
    protected $seoDescription = 'Descubre nuestros servicios funerarios integrales: inhumación, cremación, transferencia, tanatopraxia, ceremonia y más. Atención personalizada las 24 horas.';
    protected $seoKeywords = 'servicios funerarios, inhumación, cremación, tanatopraxia, transferencia, ceremonia funeral, funeral, México';

    public function render()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();

        return view('livewire.pages.servicios', compact('services'));
    }
}