<div x-data="{ showDeleteModal: false, siteToDelete: null }">
    @if (session()->has('message'))
        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200 flex items-center gap-3 animate-fade-in">
            <i class="fas fa-check-circle text-xl"></i>
            <p class="font-bold text-sm">{{ session('message') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
        <div class="w-full md:w-1/3">
            <label class="block text-xs font-bold text-stone-500 uppercase mb-1 ml-1">Buscar Bitácora</label>
            <div class="relative">
                <input wire:model.live="search" type="text" placeholder="Yacimiento o arqueólogo..." class="w-full pl-10 rounded-xl border-stone-300 focus:border-[#C56A3D] focus:ring-[#C56A3D]/30">
                <i class="fas fa-search absolute left-3 top-3 text-stone-400"></i>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <select wire:model.live="filterProvince" class="rounded-xl border-stone-300 text-sm focus:ring-[#C56A3D]/30">
                <option value="">Todas las Provincias</option>
                @if(isset($provinces))
                    @foreach($provinces as $prov)
                        <option value="{{ $prov }}">{{ $prov }}</option>
                    @endforeach
                @endif
            </select>

            @if(auth()->user()->role === 'archaeologist')
                <div class="inline-flex rounded-xl shadow-sm border border-stone-300 overflow-hidden">
                    <button wire:click="$set('viewMode', 'all')" class="px-4 py-2 text-xs font-bold {{ $viewMode === 'all' ? 'bg-[#1F4E6E] text-white' : 'bg-white text-stone-600' }}">Todos</button>
                    <button wire:click="$set('viewMode', 'mine')" class="px-4 py-2 text-xs font-bold {{ $viewMode === 'mine' ? 'bg-[#1F4E6E] text-white' : 'bg-white text-stone-600' }}">Mis Hallazgos</button>
                </div>
            @endif

            @if(in_array(auth()->user()->role, ['archaeologist', 'admin']))
                <a href="{{ route('log.create') }}" class="bg-[#C56A3D] hover:bg-[#A65D3A] text-white px-5 py-2.5 rounded-xl shadow-sm text-sm font-bold transition-transform transform hover:-translate-y-0.5 flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Nueva Bitácora
                </a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($sites as $site)
            <div class="bg-white rounded-2xl border border-[#E6DBCB] overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col">
                <div class="p-5 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $site->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $site->status === 'approved' ? 'Verificado' : 'En Revisión' }}
                        </span>
                        <span class="text-[10px] font-mono text-stone-400">#{{ str_pad($site->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <h3 class="text-lg font-serif font-bold text-[#8B5A2B] leading-tight mb-1">{{ $site->name }}</h3>
                    <div class="flex items-center gap-1 text-xs text-stone-500 mb-4">
                        <i class="fas fa-map-marker-alt text-[#C56A3D]"></i> {{ $site->province }}
                    </div>

                    <p class="text-sm text-stone-600 line-clamp-3 mb-4 italic">
                        "{{ Str::limit($site->public_description, 120) }}"
                    </p>

                    <div class="flex items-center gap-2 mt-auto pt-4 border-t border-stone-50">
                        <div class="w-8 h-8 rounded-full bg-[#F7EFE2] flex items-center justify-center text-[10px] font-bold text-[#1F4E6E] border border-[#E6DBCB]">
                            {{ substr($site->user->name, 0, 1) }}
                        </div>
                        <div class="text-[11px]">
                            <p class="font-bold text-stone-800 leading-none">{{ $site->user->name }}</p>
                            <p class="text-stone-400">{{ $site->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-stone-50 px-5 py-3 border-t border-stone-100 flex justify-between items-center">
                    <span class="text-[10px] font-bold text-[#1F4E6E] uppercase">
                        <i class="fas fa-cubes mr-1"></i> {{ $site->discoveries->count() }} Piezas
                    </span>

                    <div class="flex items-center gap-3">
                        @if(auth()->user()->role === 'admin')
                            <button type="button" @click="siteToDelete = {{ $site->id }}; showDeleteModal = true" class="text-xs text-stone-400 hover:text-red-600 transition-colors" title="Eliminar Bitácora">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        @endif

                        @can('update', $site)
                        <a href="{{ route('logs.edit', $site->id) }}" class="text-xs text-stone-400 hover:text-[#C56A3D] transition-colors" title="Editar Bitácora">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan

                        <a href="{{ route('logs.show', $site->id) }}" class="text-xs font-bold text-[#C56A3D] hover:underline flex items-center">
                            Ver Detalles <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <i class="fas fa-feather-alt text-5xl text-stone-200 mb-4"></i>
                <p class="text-stone-500 font-serif italic text-lg">No se han encontrado bitácoras registradas.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $sites->links() }}
    </div>

    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-stone-900/80 backdrop-blur-sm p-4 transition-opacity duration-300">
        <div @click.away="showDeleteModal = false" class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full shadow-2xl relative">

            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-3xl mx-auto mb-4 shadow-inner">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <h3 class="text-2xl font-serif font-bold text-center text-stone-800 mb-2">¿Eliminar Bitácora?</h3>
            <p class="text-stone-500 text-center text-sm mb-8 leading-relaxed">
                Estás a punto de eliminar permanentemente esta bitácora, todas sus piezas documentadas y los archivos multimedia asociados del servidor. <strong>Esta acción no se puede deshacer.</strong>
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button type="button" @click="showDeleteModal = false" class="px-6 py-3 rounded-xl text-stone-600 bg-stone-100 hover:bg-stone-200 font-bold transition flex-1">
                    Cancelar
                </button>
                <button type="button" @click="$wire.deleteSite(siteToDelete); showDeleteModal = false" class="px-6 py-3 rounded-xl text-white bg-red-600 hover:bg-red-700 font-bold transition shadow-md flex-1 flex justify-center items-center gap-2">
                    <i class="fas fa-trash-alt"></i> Sí, Eliminar
                </button>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</div>
