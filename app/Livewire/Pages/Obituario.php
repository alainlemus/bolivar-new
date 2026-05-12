<?php

namespace App\Livewire\Pages;

use App\Models\Obituary;
use Livewire\Component;
use Livewire\WithPagination;

class Obituario extends Component
{
    use WithPagination;

    public $search = '';

    protected $seoTitle = 'Obituario | Honora a tu ser querido';
    protected $seoDescription = 'Consulta los obituarios y avisos fúnebres de Funeraria García de Bolívar. Información sobre homenaje, capilla, fecha y hora de sepelio.';
    protected $seoKeywords = 'obituario, avisos funerarios, homenaje, sepelio, capilla, funeral';

    public function render()
    {
        $query = Obituary::active()
            ->orderBy('burial_date', 'desc');

        if ($this->search) {
            $query->where('deceased_name', 'like', '%' . $this->search . '%');
        }

        $obituaries = $query->paginate(12);

        return view('livewire.pages.obituario', compact('obituaries'));
    }
}