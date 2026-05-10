<div class="space-y-6">
    @if (session()->has('message'))
        <div class="bg-green-50 text-green-800 p-4 rounded-2xl border border-green-100 animate-fade-in flex items-center gap-3 shadow-sm">
            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-check text-xs"></i>
            </div>
            <p class="font-bold text-sm">{{ session('message') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 text-red-800 p-4 rounded-2xl border border-red-100 animate-fade-in flex items-center gap-3 shadow-sm">
            <div class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-xs"></i>
            </div>
            <p class="font-bold text-sm">{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-3xl border border-stone-100 shadow-sm">
        <div class="relative w-full md:w-1/3">
            <input wire:model.live="search" type="text" placeholder="Buscar investigador..."
                   class="w-full pl-10 pr-4 py-2.5 rounded-2xl border-stone-200 focus:border-[#C56A3D] focus:ring-[#C56A3D]/20 transition-all text-sm">
            <i class="fas fa-search absolute left-3.5 top-3.5 text-stone-300"></i>
        </div>

        <button wire:click="createUser" class="bg-[#1F4E6E] hover:bg-[#153850] text-white px-6 py-2.5 rounded-2xl font-black text-[10px] uppercase tracking-widest transition shadow-lg flex items-center gap-2">
            <i class="fas fa-plus"></i> Registrar Usuario
        </button>
    </div>

    <div class="bg-white rounded-[2rem] border border-stone-200 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-stone-50 border-b border-stone-100">
                <tr>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-stone-400 tracking-widest">Identificación</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-stone-400 tracking-widest">Rol Institucional</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-stone-400 tracking-widest">Verificación</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-stone-400 tracking-widest text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-50 text-sm">
                @foreach($users as $user)
                    <tr class="hover:bg-[#FDF9F2]/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-[#F7EFE2] flex items-center justify-center text-[#8B5A2B] font-bold border border-[#E6DBCB] shadow-inner">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-stone-800 leading-none">{{ $user->name }}</p>
                                    <p class="text-[11px] text-stone-400 mt-1">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-tighter
                                {{ $user->role === 'admin' ? 'bg-red-50 text-red-700' :
                                  ($user->role === 'ministerio' ? 'bg-blue-50 text-blue-700' : 'bg-stone-100 text-stone-600') }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="toggleVerification({{ $user->id }})" class="group flex items-center gap-2">
                                @if($user->is_verified)
                                    <span class="text-green-600 font-bold text-xs"><i class="fas fa-check-circle"></i> Activo</span>
                                @else
                                    <span class="text-stone-300 font-bold text-xs group-hover:text-orange-400 transition-colors"><i class="fas fa-clock"></i> Pendiente</span>
                                @endif
                            </button>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1">
                                <button wire:click="editUser({{ $user->id }})" class="w-8 h-8 rounded-lg text-stone-400 hover:text-[#1F4E6E] hover:bg-blue-50 transition-all flex items-center justify-center">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                @if($user->id !== auth()->id())
                                    <button wire:click="confirmUserDeletion({{ $user->id }})" class="w-8 h-8 rounded-lg text-stone-400 hover:text-red-600 hover:bg-red-50 transition-all flex items-center justify-center">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4 bg-stone-50 border-t border-stone-100">
            {{ $users->links() }}
        </div>
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-stone-900/60 backdrop-blur-sm animate-fade-in">
            <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-xl overflow-hidden border border-stone-200">
                <div class="bg-[#FDF9F2] px-8 py-6 border-b border-stone-100 flex justify-between items-center">
                    <h3 class="text-xl font-serif font-bold text-[#8B5A2B]">
                        {{ $editingUser ? 'Actualizar Expediente' : 'Nuevo Investigador' }}
                    </h3>
                    <button wire:click="resetForm" class="text-stone-300 hover:text-red-500 transition-colors"><i class="fas fa-times-circle text-xl"></i></button>
                </div>

                <form wire:submit.prevent="saveUser" class="p-8 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <x-input-label value="Nombre Completo" class="text-[10px] font-black uppercase text-stone-400 mb-1 ml-1" />
                            <input type="text" wire:model="name" class="w-full rounded-xl border-stone-200 text-sm font-bold bg-stone-50 focus:ring-[#C56A3D]/20">
                            @error('name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <x-input-label value="Email Institucional" class="text-[10px] font-black uppercase text-stone-400 mb-1 ml-1" />
                            <input type="email" wire:model="email" class="w-full rounded-xl border-stone-200 text-sm font-bold bg-stone-50 focus:ring-[#C56A3D]/20">
                        </div>
                        <div>
                            <x-input-label value="Rol de Acceso" class="text-[10px] font-black uppercase text-stone-400 mb-1 ml-1" />
                            <select wire:model="role" class="w-full rounded-xl border-stone-200 text-sm font-bold bg-stone-50">
                                <option value="archaeologist">Arqueólogo</option>
                                <option value="ministerio">Ministerio / Auditor</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>
                        @if(!$editingUser)
                            <div class="md:col-span-2">
                                <x-input-label value="Contraseña Temporal" class="text-[10px] font-black uppercase text-stone-400 mb-1 ml-1" />
                                <input type="password" wire:model="password" class="w-full rounded-xl border-stone-200 text-sm bg-stone-50">
                            </div>
                        @endif
                    </div>

                    <div class="pt-6 flex justify-end gap-3">
                        <button type="button" wire:click="resetForm" class="px-6 py-2.5 text-[10px] font-black uppercase text-stone-400 tracking-widest hover:text-stone-600 transition-colors">Cancelar</button>
                        <button type="submit" class="bg-[#C56A3D] hover:bg-[#A65D3A] text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg transition-all">
                            {{ $editingUser ? 'Guardar Cambios' : 'Confirmar Registro' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($showDeleteModal)
        <div class="fixed inset-0 z-[120] flex items-center justify-center p-4 bg-stone-900/80 backdrop-blur-md animate-fade-in">
            <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm overflow-hidden p-8 text-center border border-red-100">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 border border-red-100 shadow-inner animate-bounce">
                    <i class="fas fa-user-minus"></i>
                </div>

                <h3 class="text-xl font-serif font-bold text-stone-800 mb-2">¿Eliminar Investigador?</h3>
                <p class="text-xs text-stone-500 leading-relaxed mb-8">
                    Esta acción revocará todos los permisos de acceso y eliminará permanentemente la asociación del usuario con sus bitácoras. **Esta acción no se puede deshacer.**
                </p>

                <div class="flex flex-col gap-2">
                    <button wire:click="deleteUser" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-red-900/20 transition-all transform active:scale-95">
                        Sí, Eliminar Permanentemente
                    </button>
                    <button wire:click="$set('showDeleteModal', false)" class="w-full bg-stone-50 text-stone-500 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-stone-100">
                        Cancelar Operación
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    </style>
</div>
