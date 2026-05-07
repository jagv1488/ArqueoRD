<?php

namespace App\Livewire\Logs;

use App\Models\Site;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class LogShow extends Component
{
    public Site $site;
    public $hasFullAccess = false;

    public function mount(Site $site)
    {
        // Cargamos las relaciones necesarias
        $this->site = $site->load(['user', 'discoveries.media', 'media']);

        // VERIFICACIÓN DE SEGURIDAD (¿Puede ver coordenadas y notas privadas?)
        // 1. Si es Admin o Ministerio
        // 2. Si es el Arqueólogo que creó el registro
        $user = auth()->user();
        if (in_array($user->role, ['admin', 'ministerio']) || $user->id === $site->user_id) {
            $this->hasFullAccess = true;
        }
    }

    public function render()
    {
        return view('livewire.logs.log-show');
    }
}
