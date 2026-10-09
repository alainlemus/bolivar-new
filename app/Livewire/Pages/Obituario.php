<?php

namespace App\Livewire\Pages;

use App\Livewire\Concerns\WithSeo;
use App\Models\Obituary;
use Livewire\Component;
use Livewire\WithPagination;

class Obituario extends Component
{
    use WithPagination;
    use WithSeo;

    public $search = '';

    // todos | hoy | semana
    public $filter = 'todos';

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => 'todos'],
    ];

    public function setFilter(string $filter): void
    {
        $this->filter = in_array($filter, ['todos', 'hoy', 'semana'], true) ? $filter : 'todos';
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search']);
        $this->filter = 'todos';
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    protected $seoTitle = 'Obituario | Honora a tu ser querido';

    protected $seoDescription = 'Consulta los obituarios y avisos fúnebres de Funeraria García de Bolívar. Información sobre homenaje, capilla, fecha y hora de sepelio.';

    protected $seoKeywords = 'obituario, avisos funerarios, homenaje, sepelio, capilla, funeral';

    public function render()
    {
        $query = Obituary::active()
            ->orderBy('burial_date', 'desc');

        if ($this->search) {
            $query->where('deceased_name', 'like', '%'.$this->search.'%');
        }

        if ($this->filter === 'hoy') {
            $query->whereDate('burial_date', today());
        } elseif ($this->filter === 'semana') {
            $query->whereBetween('burial_date', [now()->startOfDay(), now()->addDays(7)->endOfDay()]);
        }

        $obituaries = $query->paginate(12);

        return view('livewire.pages.obituario', compact('obituaries'))
            ->layout('components.layouts.app', $this->seo());
    }
}
