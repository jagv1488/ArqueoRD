<div class="container mx-auto px-4 py-12">
    <div class="max-w-5xl mx-auto">

        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-stone-500 hover:text-[#C56A3D] font-bold transition-transform hover:-translate-x-1 bg-white px-5 py-2.5 rounded-full shadow-sm border border-[#E6DBCB]">
                <i class="fas fa-arrow-left mr-2"></i> Volver al Catálogo
            </a>

            <a href="{{ route('catalog.index') }}" class="text-[#1F4E6E] font-semibold hover:underline">
                <i class="fas fa-search mr-1"></i> Nueva búsqueda
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-[#E6DBCB] overflow-hidden flex flex-col md:flex-row mb-8">

            @php
                $publicImages = $site->media->where('file_type', 'image')->where('is_public', true);
                $firstImgUrl = $publicImages->first() ? asset('storage/' . $publicImages->first()->file_path) : '';
            @endphp

            <div x-data="{ activeImage: '{{ $firstImgUrl }}' }" class="md:w-1/2 bg-[#F7EFE2] relative min-h-[400px] flex flex-col border-b md:border-b-0 md:border-r border-[#E6DBCB] overflow-hidden">

                <div class="flex-grow flex items-center justify-center relative overflow-hidden bg-stone-100">
                    <template x-if="activeImage">
                        <img :src="activeImage" class="w-full h-full object-cover transition-opacity duration-300" alt="{{ $site->name }}">
                    </template>

                    <template x-if="!activeImage">
                        <div class="text-center p-10">
                            <i class="fas fa-map-marked-alt text-8xl text-[#E6DBCB] mb-4"></i>
                            <p class="text-stone-400 font-serif italic">Sin registro fotográfico general</p>
                        </div>
                    </template>

                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur px-4 py-2 rounded-2xl shadow-sm border border-[#E6DBCB] z-10">
                        <p class="text-[10px] uppercase font-bold text-stone-400 tracking-widest leading-none">ID Nacional</p>
                        <p class="text-sm font-mono font-bold text-[#1F4E6E]">ARQ-S-{{ str_pad($site->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                @if($publicImages->count() > 1)
                    <div class="flex gap-2 p-3 bg-white border-t border-[#E6DBCB] overflow-x-auto shrink-0 z-20">
                        @foreach($publicImages as $img)
                            <button
                                @click="activeImage = '{{ asset('storage/' . $img->file_path) }}'"
                                class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden border-2 transition-all duration-300 relative focus:outline-none"
                                :class="activeImage === '{{ asset('storage/' . $img->file_path) }}' ? 'border-[#C56A3D] scale-[1.02] shadow-md' : 'border-transparent opacity-60 hover:opacity-100'">
                                <img src="{{ asset('storage/' . $img->file_path) }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="md:w-1/2 p-8 md:p-12 flex flex-col">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-[#C56A3D]/10 text-[#C56A3D] text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        Bitácora Verificada
                    </span>
                    <span class="text-stone-400 text-xs">|</span>
                    <span class="text-stone-500 text-xs font-medium">
                        Fecha: {{ $site->created_at->format('M Y') }}
                    </span>
                </div>

                <h1 class="text-4xl font-serif font-bold text-[#8B5A2B] mb-6 leading-tight">{{ $site->name }}</h1>

                <div class="space-y-6 flex-grow">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-stone-50 p-4 rounded-2xl border border-stone-100">
                            <p class="text-[10px] uppercase font-bold text-stone-400 mb-1">Provincia</p>
                            <p class="text-[#1F4E6E] font-bold"><i class="fas fa-map-marker-alt text-[#C56A3D] mr-1"></i> {{ $site->province }}</p>
                        </div>
                        <div class="bg-stone-50 p-4 rounded-2xl border border-stone-100">
                            <p class="text-[10px] uppercase font-bold text-stone-400 mb-1">Época Estimada</p>
                            <p class="text-stone-700 font-bold">{{ $site->period ?? 'Por determinar' }}</p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-stone-800 mb-2 uppercase tracking-wide">Contexto Histórico</h4>
                        <p class="text-stone-600 leading-relaxed italic text-sm">
                            "{{ $site->public_description }}"
                        </p>
                    </div>

                    <div class="pt-6 border-t border-stone-100">
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between text-sm">
                                <span class="text-stone-400">Arqueólogo a cargo</span>
                                <span class="font-bold text-stone-700">{{ $site->user->name }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 bg-blue-50 border border-blue-100 p-4 rounded-xl flex items-start gap-3">
                    <i class="fas fa-shield-alt text-blue-400 mt-0.5"></i>
                    <p class="text-[11px] text-blue-800 leading-snug">
                        Coordenadas y estratigrafía ocultas por normativas de seguridad patrimonial para prevenir el saqueo.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-[#E6DBCB] p-8">
            <h3 class="text-2xl font-serif font-bold text-[#1F4E6E] mb-6">
                <i class="fas fa-cubes text-[#C56A3D] mr-2"></i> Artefactos Extraídos y Documentados ({{ $site->discoveries->count() }})
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($site->discoveries as $item)
                    <div class="flex items-center gap-4 bg-stone-50 p-4 rounded-2xl border border-stone-200">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#8B5A2B] shadow-sm border border-[#E6DBCB] flex-shrink-0">
                            @if($item->material_category == 'Cerámico') <i class="fas fa-prescription-bottle text-xl"></i>
                            @elseif($item->material_category == 'Lítico') <i class="fas fa-gem text-xl"></i>
                            @elseif($item->material_category == 'Metálico') <i class="fas fa-coins text-xl"></i>
                            @else <i class="fas fa-vihara text-xl"></i> @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-stone-800">{{ $item->name }}</h4>
                            <p class="text-xs text-stone-500 font-mono mt-0.5">{{ $item->registration_code }} <span class="mx-1">|</span> {{ $item->conservation_status }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-stone-500 italic col-span-full">Las piezas de este yacimiento aún están siendo catalogadas.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
