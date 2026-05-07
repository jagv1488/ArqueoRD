<?php

namespace App\Livewire\Logs;

use App\Models\Site;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage; // Importante para borrar archivos

class LogIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $filterProvince = '';
    public $viewMode = 'all';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterProvince() { $this->resetPage(); }
    public function updatingViewMode() { $this->resetPage(); }

    // --- NUEVO MÉTODO DE ELIMINACIÓN ---
    public function deleteSite($id)
    {
        // 1. Validar que estrictamente sea un Administrador
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acceso denegado. Solo los administradores pueden eliminar registros.');
        }

        $site = Site::with(['media', 'discoveries.media'])->findOrFail($id);

        // 2. Eliminar archivos multimedia del yacimiento del servidor físico
        foreach ($site->media as $media) {
            Storage::disk('public')->delete($media->file_path);
            $media->delete();
        }

        // 3. Eliminar archivos multimedia de los artefactos y luego los artefactos
        foreach ($site->discoveries as $discovery) {
            foreach ($discovery->media as $media) {
                Storage::disk('public')->delete($media->file_path);
                $media->delete();
            }
            $discovery->delete();
        }

        // 4. Finalmente, eliminar el registro principal de la bitácora
        $site->delete();

        session()->flash('message', 'Bitácora y todos sus archivos eliminados permanentemente.');
    }

    public function render()
    {
        $query = Site::query()->with(['user', 'discoveries']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($u) {
                      $u->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->filterProvince) {
            $query->where('province', $this->filterProvince);
        }

        if ($this->viewMode === 'mine') {
            $query->where('user_id', auth()->id());
        }

        $sites = $query->latest()->paginate(9);

        $provinces = Site::select('province')
            ->whereNotNull('province')
            ->distinct()
            ->orderBy('province')
            ->pluck('province');

        return view('livewire.logs.log-index', [
            'sites' => $sites,
            'provinces' => $provinces
        ]);
    }
}
