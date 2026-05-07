<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.public')]
class PublicCatalog extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Consultamos las Bitácoras (Sites) aprobadas
        $sites = Site::with(['media', 'discoveries'])
            ->where('status', 'approved')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('province', 'like', '%' . $this->search . '%')
                      ->orWhereHas('discoveries', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('material_category', 'like', '%' . $this->search . '%');
                      });
            })
            ->latest()
            ->paginate(9);

        return view('livewire.public-catalog', [
            'sites' => $sites // <-- Aquí pasamos la variable $sites a la vista
        ]);
    }
}
