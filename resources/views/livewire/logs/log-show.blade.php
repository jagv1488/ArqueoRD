<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <a href="{{ route('logs.index') }}" class="inline-flex items-center text-stone-500 hover:text-[#C56A3D] font-semibold transition-all duration-300 transform hover:-translate-x-1">
            <i class="fas fa-arrow-left mr-2"></i> Volver al Explorador
        </a>

        <div class="flex flex-wrap justify-center sm:justify-end gap-3">
            @can('update', $site)
            <a href="{{ route('logs.edit', $site->id) }}" class="bg-white border-2 border-[#1F4E6E] text-[#1F4E6E] hover:bg-[#1F4E6E] hover:text-white px-5 py-2.5 rounded-xl shadow-sm text-sm font-bold flex items-center gap-2 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                <i class="fas fa-edit"></i> Editar Bitácora
            </a>
            @endcan

            <a href="{{ route('report.pdf', $site->id) }}" class="bg-[#1F4E6E] hover:bg-[#153850] text-white px-5 py-2.5 rounded-xl shadow-md text-sm font-bold flex items-center gap-2 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                <i class="fas fa-file-pdf"></i> Exportar Reporte
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-[#E6DBCB] p-8 mb-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-40 h-40 bg-[#F7EFE2] rounded-bl-full -z-10 opacity-60"></div>

        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider {{ $site->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        <i class="fas {{ $site->status === 'approved' ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i>
                        {{ $site->status === 'approved' ? 'Verificado' : 'En Revisión' }}
                    </span>
                    <span class="text-xs font-mono text-stone-400 bg-stone-50 px-2 py-1 rounded-md border border-stone-100">
                        ARQ-S-{{ str_pad($site->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-[#8B5A2B] mb-2">{{ $site->name }}</h1>
                <p class="text-stone-500 flex items-center gap-2 font-medium text-sm">
                    <i class="fas fa-map-marker-alt text-[#C56A3D]"></i> {{ $site->province }}
                    <span class="mx-2 text-stone-300">|</span>
                    <i class="fas fa-hourglass-half text-[#1F4E6E]"></i> Período: {{ $site->period ?? 'ND' }}
                </p>
            </div>

            <div class="bg-stone-50 border border-stone-200 rounded-2xl p-4 flex items-center gap-4 min-w-[260px] shadow-sm">
                <div class="w-12 h-12 rounded-full bg-[#1F4E6E] text-white flex items-center justify-center font-bold text-xl shadow-inner border-2 border-white">
                    {{ substr($site->user->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-[10px] text-stone-500 uppercase font-bold tracking-widest">Investigador</p>
                    <p class="font-bold text-stone-800 leading-tight mt-0.5">{{ $site->user->name }}</p>
                    <p class="text-xs text-stone-500 mt-0.5">{{ $site->user->institution ?? 'Independiente' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-2xl shadow-sm border border-[#E6DBCB] p-6">
                <h3 class="text-lg font-bold text-stone-800 border-b border-stone-100 pb-3 mb-4">
                    <i class="fas fa-align-left text-[#C56A3D] mr-2"></i> Descripción General
                </h3>
                <p class="text-stone-600 leading-relaxed whitespace-pre-line">{{ $site->public_description }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-[#E6DBCB] p-6">
                <div class="flex justify-between items-center border-b border-stone-100 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-stone-800">
                        <i class="fas fa-cubes text-[#C56A3D] mr-2"></i> Inventario de Piezas ({{ $site->discoveries->count() }})
                    </h3>
                </div>
                <div class="space-y-4">
                    @forelse ($site->discoveries as $discovery)
                        <div class="border border-stone-200 rounded-xl p-4 flex flex-col sm:flex-row gap-4 bg-white hover:bg-[#FDF9F2] transition-all duration-300">
                            @php $pieceImg = $discovery->media->where('file_type', 'image')->first(); @endphp
                            <div class="w-16 h-16 bg-[#F7EFE2] border border-[#E6DBCB] rounded-xl flex items-center justify-center flex-shrink-0 text-[#1F4E6E] overflow-hidden">
                                @if($pieceImg)
                                    <img src="{{ asset('storage/' . $pieceImg->file_path) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-vihara text-2xl opacity-80"></i>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-[#8B5A2B]">{{ $discovery->name }}</h4>
                                    <span class="text-[10px] font-mono bg-stone-100 border border-stone-200 text-stone-600 px-2 py-1 rounded-md">{{ $discovery->registration_code }}</span>
                                </div>
                                <div class="text-[11px] font-medium text-stone-500 mt-2 flex flex-wrap gap-2">
                                    <span class="bg-stone-50 border border-stone-100 px-2 py-1 rounded"><i class="fas fa-tag"></i> {{ $discovery->material_category }}</span>
                                    <span class="bg-stone-50 border border-stone-100 px-2 py-1 rounded"><i class="fas fa-heartbeat"></i> {{ $discovery->conservation_status }}</span>
                                </div>
                                @if($hasFullAccess && $discovery->private_notes)
                                    <div class="mt-3 bg-red-50 text-red-800 text-xs p-3 rounded-lg border border-red-100">
                                        <strong><i class="fas fa-microscope mr-1"></i> Nota Técnica:</strong>
                                        Capa: {{ $discovery->stratigraphic_layer ?? 'N/A' }} ({{ $discovery->depth_cm }}cm). {{ $discovery->private_notes }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    @empty
                        <p class="text-stone-500 italic text-center py-4">No hay piezas registradas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-8">

            <div class="bg-white rounded-2xl shadow-sm border {{ $hasFullAccess ? 'border-red-200 shadow-red-50' : 'border-[#E6DBCB]' }} overflow-hidden">
                <div class="{{ $hasFullAccess ? 'bg-red-50 text-red-800' : 'bg-stone-100 text-stone-600' }} px-6 py-4 font-bold flex justify-between items-center border-b {{ $hasFullAccess ? 'border-red-200' : 'border-stone-200' }}">
                    <span><i class="fas {{ $hasFullAccess ? 'fa-unlock' : 'fa-lock' }} mr-2"></i> Datos Geoespaciales</span>
                </div>
                <div class="p-6">
                    @if($hasFullAccess)
                        <p class="font-mono text-stone-800 bg-stone-50 border border-stone-200 p-3 rounded-lg text-sm mb-4">
                            Lat: <span class="font-bold">{{ $site->latitude ?? 'N/D' }}</span> <br>
                            Lon: <span class="font-bold">{{ $site->longitude ?? 'N/D' }}</span>
                        </p>
                        <p class="text-[10px] font-bold text-stone-500 uppercase">Amenaza: <span class="text-red-600">{{ $site->threat_level }}</span></p>
                        @if($site->technical_notes)
                            <div class="border-t border-stone-100 pt-3 mt-3">
                                <p class="text-[10px] font-bold text-stone-500 uppercase mb-1">Notas Topográficas</p>
                                <p class="text-xs text-stone-600">{{ $site->technical_notes }}</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-shield-alt text-2xl text-stone-400 mb-2"></i>
                            <h4 class="font-bold text-stone-700">Protegido</h4>
                            <p class="text-xs text-stone-500 mt-1">Coordenadas ocultas por seguridad.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-[#E6DBCB] p-6" x-data="{ lightboxOpen: false, activeImg: '' }">
                <h3 class="text-lg font-bold text-stone-800 border-b border-stone-100 pb-3 mb-4">
                    <i class="fas fa-camera text-[#C56A3D] mr-2"></i> Galería de Evidencia
                </h3>

                @php
                    $images = $site->media->where('file_type', 'image');
                    $videos = $site->media->where('file_type', 'video');
                    $audios = $site->media->where('file_type', 'audio');
                @endphp

                @if($images->isEmpty() && $videos->isEmpty() && $audios->isEmpty())
                    <div class="text-center py-6 border-2 border-dashed border-stone-200 rounded-xl bg-stone-50">
                        <i class="fas fa-image text-2xl text-stone-300 mb-2"></i>
                        <p class="text-xs text-stone-500">Sin evidencia visual</p>
                    </div>
                @else

                    @if($images->isNotEmpty())
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            @foreach($images as $img)
                                <div @click="lightboxOpen = true; activeImg = '{{ asset('storage/' . $img->file_path) }}'" class="aspect-square rounded-xl overflow-hidden cursor-pointer border border-stone-200 group relative">
                                    <img src="{{ asset('storage/' . $img->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                        <i class="fas fa-expand text-white opacity-0 group-hover:opacity-100 transition-opacity text-xl"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($videos->isNotEmpty())
                        <div class="mt-4 border-t border-stone-100 pt-4">
                            <p class="text-[10px] font-bold text-stone-500 uppercase mb-3"><i class="fas fa-film mr-1 text-[#1F4E6E]"></i> Videos</p>
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($videos as $vid)
                                    <div class="bg-black rounded-xl overflow-hidden border border-stone-200 shadow-inner">
                                        <video controls class="w-full h-auto max-h-48 object-contain bg-black outline-none">
                                            <source src="{{ asset('storage/' . $vid->file_path) }}" type="video/mp4">
                                            Tu navegador no soporta video HTML5.
                                        </video>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($audios->isNotEmpty())
                        <div class="space-y-2 border-t border-stone-100 pt-4 mt-4">
                            <p class="text-[10px] font-bold text-stone-500 uppercase mb-2">Audios</p>
                            @foreach($audios as $audio)
                                <a href="{{ asset('storage/' . $audio->file_path) }}" target="_blank" class="flex items-center gap-3 bg-stone-50 hover:bg-stone-100 border border-stone-200 p-2 rounded-lg transition text-xs font-medium text-[#1F4E6E]">
                                    <i class="fas fa-file-audio text-[#C56A3D] text-lg"></i>
                                    Reproducir nota de audio
                                </a>
                            @endforeach
                        </div>
                    @endif
                @endif

                <div x-show="lightboxOpen" x-cloak class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300">
                    <button @click="lightboxOpen = false" class="absolute top-6 right-6 text-white hover:text-red-500 transition-colors z-50">
                        <i class="fas fa-times text-4xl"></i>
                    </button>
                    <img :src="activeImg" class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl relative z-40" @click.away="lightboxOpen = false">
                </div>
            </div>

        </div>
    </div>
</div>
