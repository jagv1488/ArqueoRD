<?php

namespace App\Livewire;

use App\Models\Site;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PublicShow extends Component
{
    public Site $site;

    public function mount($id)
    {
        // Cargamos la Bitácora, asegurando que esté aprobada, junto a su creador, fotos y piezas
        $this->site = Site::with(['media', 'discoveries.media', 'user'])
            ->where('status', 'approved')
            ->findOrFail($id);
    }

    #[Layout('components.layouts.public')]
    public function render()
    {
        return view('livewire.public-show');
    }
}
