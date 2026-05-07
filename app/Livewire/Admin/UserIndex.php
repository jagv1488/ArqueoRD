<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';

    // Resetea la paginación cuando el usuario escribe en el buscador
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Función para aprobar o revocar el acceso de un arqueólogo
    public function toggleVerification($userId)
    {
        // Por seguridad, aquí deberías verificar que el usuario actual es Admin
        if (auth()->user()->role !== 'admin' && auth()->user()->role !== 'ministerio') {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        $user = User::findOrFail($userId);

        // No permitimos que los admins se quiten la verificación a sí mismos por error
        if ($user->id === auth()->id()) {
            return;
        }

        $user->is_verified = !$user->is_verified;
        $user->save();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('license_number', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.user-index', [
            'users' => $users
        ]);
    }
}
