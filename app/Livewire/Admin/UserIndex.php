<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';

    // Estados de Modales
    public $showModal = false;
    public $showDeleteModal = false;

    // Datos de Usuario
    public $editingUser = null;
    public $userToDeleteId = null;

    // Campos del Formulario
    public $name, $email, $role = 'archaeologist', $license_number, $institution, $password;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Gestión de Modal de Registro/Edición
     */
    public function createUser()
    {
        $this->resetForm();
        $this->editingUser = null;
        $this->showModal = true;
    }

    public function editUser(User $user)
    {
        $this->resetForm();
        $this->editingUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->license_number = $user->license_number;
        $this->institution = $user->institution;
        $this->showModal = true;
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'role', 'license_number', 'institution', 'password', 'editingUser', 'showModal', 'showDeleteModal', 'userToDeleteId']);
    }

    public function saveUser()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->editingUser?->id)],
            'role' => 'required|in:admin,archaeologist,ministerio',
            'license_number' => 'nullable|string',
            'institution' => 'nullable|string',
        ];

        if (!$this->editingUser) {
            $rules['password'] = 'required|min:8';
        }

        $this->validate($rules);

        if ($this->editingUser) {
            $this->editingUser->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'license_number' => $this->license_number,
                'institution' => $this->institution,
            ]);
            session()->flash('message', 'Perfil de investigador actualizado correctamente.');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'license_number' => $this->license_number,
                'institution' => $this->institution,
                'password' => Hash::make($this->password),
                'is_verified' => true,
            ]);
            session()->flash('message', 'Nuevo investigador registrado en el sistema.');
        }

        $this->showModal = false;
    }

    /**
     * Gestión de Verificación
     */
    public function toggleVerification($userId)
    {
        $user = User::findOrFail($userId);
        if ($user->id === auth()->id()) return;

        $user->is_verified = !$user->is_verified;
        $user->save();

        $status = $user->is_verified ? 'verificado' : 'desactivado';
        session()->flash('message', "El usuario {$user->name} ha sido {$status}.");
    }

    /**
     * Gestión de Eliminación con Confirmación
     */
    public function confirmUserDeletion($userId)
    {
        $this->userToDeleteId = $userId;
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        if ($this->userToDeleteId === auth()->id()) {
            session()->flash('error', 'No es posible eliminar su propia cuenta administrativa.');
            $this->showDeleteModal = false;
            return;
        }

        $user = User::findOrFail($this->userToDeleteId);
        $userName = $user->name;
        $user->delete();

        $this->showDeleteModal = false;
        $this->userToDeleteId = null;

        session()->flash('message', "Investigador {$userName} eliminado permanentemente.");
    }

    public function render()
    {
        $users = User::where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('license_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.user-index', [
            'users' => $users
        ]);
    }
}
