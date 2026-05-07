<div>
    <div class="max-w-2xl mx-auto mb-12 relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-search text-[#C56A3D]"></i>
        </div>
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Buscar por yacimiento, provincia o pieza (Ej: Chacuey, La Vega)..."
            class="w-full pl-12 pr-4 py-4 rounded-full border-2 border-[#E6DBCB] bg-white shadow-sm focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/20 text-stone-700 transition-all text-lg"
        >
        <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-4 flex items-center">
            <i class="fas fa-circle-notch fa-spin text-[#C56A3D]"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative">

        @forelse($sites as $site)
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-[#E6DBCB] flex flex-col z-10">

                <div class="h-56 bg-[#F7EFE2] relative border-b border-[#E6DBCB] flex items-center justify-center overflow-hidden">
                    @php
                        $image = $site->media->where('file_type', 'image')->where('is_public', true)->first();
                    @endphp

                    @if($image)
                        <img src="{{ asset('storage/' . $image->file_path) }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" alt="{{ $site->name }}">
                    @else
                        <i class="fas fa-map-marked-alt text-6xl text-[#E6DBCB]"></i>
                    @endif

                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-[#8B5A2B] text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        {{ $site->discoveries->count() }} Artefactos
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-serif font-bold text-[#1F4E6E] mb-2 leading-tight">{{ $site->name }}</h3>
                    <div class="flex items-center gap-2 text-sm text-stone-500 mb-3 font-medium">
                        <i class="fas fa-map-marker-alt text-[#C56A3D]"></i> {{ $site->province }}
                        <span class="text-stone-300">|</span>
                        <i class="fas fa-hourglass-half text-[#8B5A2B]"></i> {{ $site->period ?? 'ND' }}
                    </div>

                    <p class="text-stone-600 text-sm line-clamp-3 mb-4 flex-grow">
                        {{ $site->public_description ?? 'Bitácora arqueológica registrada en el Archivo Nacional.' }}
                    </p>

                    <a href="{{ route('discovery.public', $site->id) }}" class="mt-auto inline-flex items-center text-[#C56A3D] font-bold hover:text-[#8B5A2B] transition-colors group bg-[#FDF9F2] px-4 py-2 rounded-xl border border-[#E6DBCB] text-center justify-center">
                        Explorar Yacimiento <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center z-10 bg-white/50 backdrop-blur-sm rounded-3xl border border-[#E6DBCB]">
                <i class="fas fa-search-minus text-5xl text-stone-300 mb-4"></i>
                <h3 class="text-xl font-serif font-bold text-[#8B5A2B]">No se encontraron bitácoras públicas</h3>
                <p class="text-stone-500 mt-2">Intenta buscar con otros términos o explora las provincias.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 z-10 relative">
        {{ $sites->links() }}
    </div>
</div>
