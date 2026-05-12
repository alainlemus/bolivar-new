<?php

namespace App\Livewire\Pages;

use App\Models\Obituary;
use Livewire\Component;
use Livewire\WithPagination;

class Obituario extends Component
{
    use WithPagination;

    public $search = '';

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