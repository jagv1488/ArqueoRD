<div>
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-serif font-bold text-[#8B5A2B]">Gestión de Personal</h2>

        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-stone-400"></i>
            </div>
            <input wire:model.live="search" type="text" placeholder="Buscar por nombre, correo o matrícula..." class="block w-full pl-10 py-2 border-stone-300 focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/30 rounded-xl shadow-sm text-sm transition">
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-[#E6DBCB] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap text-left text-sm text-stone-600">
                <thead class="bg-[#FDF9F2] border-b border-[#E6DBCB] text-stone-700 font-semibold">
                    <tr>
                        <th scope="col" class="px-6 py-4">Usuario</th>
                        <th scope="col" class="px-6 py-4">Rol / Institución</th>
                        <th scope="col" class="px-6 py-4">Matrícula</th>
                        <th scope="col" class="px-6 py-4 text-center">Estado de Acceso</th>
                        <th scope="col" class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-stone-50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#1F4E6E] text-white flex items-center justify-center font-bold shadow-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-stone-800">{{ $user->name }}</p>
                                        <p class="text-xs text-stone-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($user->role === 'admin' || $user->role === 'ministerio') bg-purple-100 text-purple-700
                                    @elseif($user->role === 'archaeologist') bg-[#1F4E6E]/10 text-[#1F4E6E]
                                    @else bg-stone-100 text-stone-600 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                                <p class="text-xs text-stone-500 mt-1 truncate max-w-[150px]">{{ $user->institution ?? 'N/A' }}</p>
                            </td>

                            <td class="px-6 py-4 font-mono text-xs">
                                {{ $user->license_number ?? '---' }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->role === 'public')
                                    <span class="text-stone-400 text-xs"><i class="fas fa-globe"></i> Público</span>
                                @elseif($user->is_verified)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle"></i> Aprobado
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock"></i> Pendiente
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->role === 'archaeologist')
                                    <button
                                        wire:click="toggleVerification({{ $user->id }})"
                                        wire:loading.attr="disabled"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold text-white shadow-sm transition-all transform hover:-translate-y-0.5
                                        {{ $user->is_verified ? 'bg-red-500 hover:bg-red-600' : 'bg-[#C56A3D] hover:bg-[#A65D3A]' }}">

                                        <span wire:loading.remove wire:target="toggleVerification({{ $user->id }})">
                                            {{ $user->is_verified ? 'Revocar Acceso' : 'Verificar Licencia' }}
                                        </span>
                                        <span wire:loading wire:target="toggleVerification({{ $user->id }})">
                                            <i class="fas fa-spinner fa-spin"></i> Procesando
                                        </span>
                                    </button>
                                @else
                                    <span class="text-stone-300 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-stone-500">
                                <i class="fas fa-users-slash text-4xl mb-3 text-stone-300"></i>
                                <p>No se encontraron usuarios con ese criterio.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-[#E6DBCB] bg-stone-50">
            {{ $users->links() }}
        </div>
    </div>
</div>
