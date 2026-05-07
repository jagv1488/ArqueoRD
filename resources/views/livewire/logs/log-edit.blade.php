<div class="max-w-6xl mx-auto py-8 px-4" x-data="{ tab: 'general' }">
    <!-- Encabezado de Edición -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-serif font-bold text-[#8B5A2B]">Editar Bitácora Maestra</h2>
            <p class="text-stone-500 font-medium italic">ID: ARQ-S-{{ str_pad($site->id, 4, '0', STR_PAD_LEFT) }} |
                {{ $name }}</p>
        </div>
        <a href="{{ route('logs.show', $site) }}"
            class="inline-flex items-center text-stone-500 hover:text-red-600 font-bold transition-colors bg-white px-4 py-2 rounded-xl shadow-sm border border-stone-200">
            <i class="fas fa-times-circle mr-2"></i> Cancelar Edición
        </a>
    </div>

    @if (session()->has('error'))
        <div
            class="mb-6 bg-red-50 text-red-700 p-4 rounded-2xl border border-red-200 flex items-center gap-3 animate-pulse">
            <i class="fas fa-exclamation-triangle text-xl"></i>
            <p class="font-bold text-sm">{{ session('error') }}</p>
        </div>
    @endif

    <form wire:submit.prevent="save" class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- COLUMNA PRINCIPAL (Información y Piezas) -->
        <div class="lg:col-span-2 space-y-8">

            <!-- SECCIÓN 1: Descripción General del Yacimiento -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-[#E6DBCB] shadow-sm">
                <h3 class="text-xl font-serif font-bold text-[#1F4E6E] mb-6 flex items-center">
                    <i class="fas fa-file-alt text-[#C56A3D] mr-3"></i> Descripción General del Yacimiento
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Nombre
                            Oficial del Sitio</label>
                        <input type="text" wire:model="name"
                            class="w-full rounded-2xl border-stone-200 bg-stone-50 focus:border-[#C56A3D] focus:ring-[#C56A3D]/20 transition-all font-bold text-[#283618]">
                        @error('name')
                            <span class="text-red-500 text-[10px] font-bold mt-1 block ml-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label
                            class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Provincia
                            / Región</label>
                        <input type="text" wire:model="province" list="provincias"
                            class="w-full rounded-2xl border-stone-200 bg-stone-50 focus:border-[#C56A3D] focus:ring-[#C56A3D]/20">
                    </div>

                    <div>
                        <label
                            class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Período
                            Histórico</label>
                        <input type="text" wire:model="period"
                            class="w-full rounded-2xl border-stone-200 bg-stone-50">
                    </div>

                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Descripción
                            para el Catálogo Público</label>
                        <textarea wire:model="public_description" rows="4"
                            class="w-full rounded-2xl border-stone-200 bg-stone-50 text-sm italic text-stone-600"
                            placeholder="Resumen del yacimiento para difusión cultural..."></textarea>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 2: Control Geoespacial (Datos Sensibles) -->
            <div class="bg-white p-8 rounded-[2.5rem] border-2 border-red-50 shadow-md">
                <h3 class="text-xl font-serif font-bold text-[#8B5A2B] mb-2 flex items-center">
                    <i class="fas fa-satellite-dish text-[#C56A3D] mr-3 animate-pulse"></i> Control Geoespacial (Datos
                    Sensibles)
                </h3>
                <p class="text-[10px] text-red-400 font-bold uppercase tracking-widest mb-6 ml-10">Acceso Restringido -
                    Solo Ministerio de Cultura e Investigadores Autorizados</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label
                            class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Latitud
                            Exacta</label>
                        <input type="number" step="any" wire:model="latitude"
                            class="w-full rounded-2xl border-stone-200 bg-[#FDF9F2] font-mono font-bold text-[#1F4E6E]">
                    </div>
                    <div>
                        <label
                            class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Longitud
                            Exacta</label>
                        <input type="number" step="any" wire:model="longitude"
                            class="w-full rounded-2xl border-stone-200 bg-[#FDF9F2] font-mono font-bold text-[#1F4E6E]">
                    </div>
                    <div>
                        <label
                            class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Elevación
                            (msnm)</label>
                        <input type="text" wire:model="elevation"
                            class="w-full rounded-2xl border-stone-200 bg-[#FDF9F2] font-bold">
                    </div>

                    <div class="md:col-span-3 py-4 border-y border-stone-100 my-2">
                        <label
                            class="block text-xs font-black text-[#BC6C25] uppercase tracking-widest mb-4 ml-1">Estado
                            de Vulnerabilidad del Sitio (Amenaza)</label>
                        <div class="flex flex-wrap gap-6">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model="threat_level" value="low"
                                    class="w-5 h-5 text-yellow-500 focus:ring-yellow-400 border-stone-300">
                                <span
                                    class="text-sm font-bold text-stone-600 group-hover:text-yellow-600 transition-colors">Bajo
                                    / Ninguno</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model="threat_level" value="medium"
                                    class="w-5 h-5 text-orange-500 focus:ring-orange-400 border-stone-300">
                                <span
                                    class="text-sm font-bold text-stone-600 group-hover:text-orange-600 transition-colors">Medio
                                    (Riesgo de Erosión)</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model="threat_level" value="high"
                                    class="w-5 h-5 text-red-600 focus:ring-red-500 border-stone-300">
                                <span
                                    class="text-sm font-bold text-stone-600 group-hover:text-red-700 transition-colors">Alto
                                    (Saqueo u Obras)</span>
                            </label>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Notas
                            Técnicas del Terreno (Confidencial)</label>
                        <textarea wire:model="technical_notes" rows="3"
                            class="w-full rounded-2xl border-stone-200 bg-[#FDF9F2] text-sm text-[#283618]"
                            placeholder="Detalles de geología, estratigrafía base o condiciones de excavación..."></textarea>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 3: Inventario de Artefactos (DINÁMICO) -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-[#E6DBCB] shadow-sm">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <h3 class="text-xl font-serif font-bold text-[#1F4E6E] flex items-center">
                        <i class="fas fa-cubes text-[#C56A3D] mr-3"></i> Inventario de Piezas Registradas
                    </h3>
                    <button type="button" wire:click="addDiscovery"
                        class="bg-[#1F4E6E] text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-md hover:bg-[#153850] transition-all transform hover:scale-105">
                        <i class="fas fa-plus-circle mr-2"></i> Añadir Nuevo Artefacto
                    </button>
                </div>

                <div class="space-y-6">
                    @forelse($discoveries as $index => $discovery)
                        <div
                            class="p-6 border-2 border-stone-100 rounded-[2rem] bg-stone-50/50 relative group hover:border-[#D4A373]/30 transition-all">
                            <button type="button" wire:click="removeDiscovery({{ $index }})"
                                class="absolute -top-3 -right-3 bg-red-100 text-red-600 w-8 h-8 rounded-full shadow-sm hover:bg-red-600 hover:text-white transition-all flex items-center justify-center">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div class="lg:col-span-2">
                                    <label
                                        class="block text-[9px] font-black text-stone-400 uppercase tracking-widest mb-1">Nombre
                                        de la Pieza</label>
                                    <input type="text" wire:model="discoveries.{{ $index }}.name"
                                        class="w-full rounded-xl border-stone-200 text-sm font-bold text-[#1F4E6E]">
                                </div>
                                <div>
                                    <label
                                        class="block text-[9px] font-black text-stone-400 uppercase tracking-widest mb-1">Material</label>
                                    <select wire:model="discoveries.{{ $index }}.material_category"
                                        class="w-full rounded-xl border-stone-200 text-xs font-bold">
                                        <option value="Cerámico">Cerámico</option>
                                        <option value="Lítico">Lítico</option>
                                        <option value="Óseo">Óseo</option>
                                        <option value="Metálico">Metálico</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-[9px] font-black text-stone-400 uppercase tracking-widest mb-1">Estado</label>
                                    <select wire:model="discoveries.{{ $index }}.conservation_status"
                                        class="w-full rounded-xl border-stone-200 text-xs font-bold text-[#BC6C25]">
                                        <option value="Intacto">Intacto</option>
                                        <option value="Fragmentado">Fragmentado</option>
                                        <option value="Muy Deteriorado">Muy Deteriorado</option>
                                    </select>
                                </div>
                                <div class="lg:col-span-1">
                                    <label
                                        class="block text-[9px] font-black text-stone-400 uppercase tracking-widest mb-1">Profundidad
                                        (cm)</label>
                                    <input type="number" wire:model="discoveries.{{ $index }}.depth_cm"
                                        class="w-full rounded-xl border-stone-200 text-sm font-mono">
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[9px] font-black text-[#BC6C25] uppercase tracking-widest mb-1">
                                Nota Técnica Actualizada
                            </label>
                            <textarea wire:model="discoveries.{{ $index }}.private_notes" rows="2"
                                class="w-full rounded-xl border-stone-200 text-xs italic bg-white"></textarea>
                        </div>
                    @empty
                        <div
                            class="text-center py-12 border-2 border-dashed border-stone-200 rounded-[2rem] bg-stone-50">
                            <i class="fas fa-box-open text-4xl text-stone-200 mb-3"></i>
                            <p class="text-xs font-bold text-stone-400 uppercase tracking-widest">No hay piezas en el
                                inventario actual</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- COLUMNA LATERAL (Galería y Multimedia) -->
        <div class="space-y-8">

            <!-- SECCIÓN: Galería de Evidencia -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-[#E6DBCB] shadow-sm sticky top-24">
                <h3 class="text-lg font-serif font-bold text-[#8B5A2B] mb-6 flex items-center">
                    <i class="fas fa-camera-retro text-[#C56A3D] mr-3"></i> Galería de Evidencia
                </h3>

                <!-- Subida Multimedia Multiple -->
                <div class="space-y-4 mb-8">
                    <label
                        class="group block border-2 border-dashed border-[#D4A373]/40 rounded-3xl p-6 text-center cursor-pointer hover:bg-[#FDF9F2] transition-all relative overflow-hidden">
                        <input type="file" wire:model="new_attachments" multiple
                            class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        <div class="relative z-0">
                            <div
                                class="w-12 h-12 bg-[#FEFAE0] rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-inner">
                                <i
                                    class="fas fa-cloud-upload-alt text-[#BC6C25] text-xl group-hover:scale-125 transition-transform"></i>
                            </div>
                            <p class="text-[10px] font-black text-stone-600 uppercase tracking-widest">Añadir Archivos
                                de Campo</p>
                            <p class="text-[9px] text-stone-400 mt-1 font-medium">Fotos, Videos o Audios (Máx. 20MB
                                c/u)</p>
                        </div>
                    </label>
                    <div wire:loading wire:target="new_attachments"
                        class="text-[10px] text-[#BC6C25] font-black uppercase italic animate-pulse flex items-center justify-center">
                        <i class="fas fa-sync fa-spin mr-2"></i> Procesando Archivos...
                    </div>
                </div>

                <!-- Archivos Actuales -->
                <div class="space-y-6">
                    <!-- Fotos -->
                    @if ($site->media->where('file_type', 'image')->count() > 0)
                        <div>
                            <p
                                class="text-[9px] font-black text-stone-400 uppercase tracking-widest mb-3 border-b border-stone-100 pb-1">
                                Fotos Publicadas</p>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($site->media->where('file_type', 'image') as $media)
                                    <div
                                        class="relative group aspect-square rounded-2xl overflow-hidden border border-stone-200 shadow-sm transition-all hover:shadow-md">
                                        <img src="{{ asset('storage/' . $media->file_path) }}"
                                            class="w-full h-full object-cover">
                                        <button type="button" wire:click="deleteMedia({{ $media->id }})"
                                            wire:confirm="¿Eliminar esta fotografía permanentemente?"
                                            class="absolute top-2 right-2 bg-red-600 text-white w-6 h-6 rounded-full text-[10px] opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center shadow-lg">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Videos/Otros -->
                    @if ($site->media->whereIn('file_type', ['video', 'audio'])->count() > 0)
                        <div class="pt-4">
                            <p
                                class="text-[9px] font-black text-stone-400 uppercase tracking-widest mb-3 border-b border-stone-100 pb-1">
                                Multimedia Documental</p>
                            <div class="space-y-2">
                                @foreach ($site->media->whereIn('file_type', ['video', 'audio']) as $media)
                                    <div
                                        class="flex items-center justify-between bg-stone-50 border border-stone-200 p-3 rounded-xl group transition-colors hover:bg-stone-100">
                                        <div class="flex items-center gap-3">
                                            <i
                                                class="fas {{ $media->file_type === 'video' ? 'fa-film text-blue-500' : 'fa-microphone text-purple-500' }} text-sm"></i>
                                            <span
                                                class="text-[10px] font-bold text-stone-600 truncate max-w-[120px]">REF:
                                                #{{ $media->id }}</span>
                                        </div>
                                        <button type="button" wire:click="deleteMedia({{ $media->id }})"
                                            wire:confirm="¿Eliminar este archivo multimedia?"
                                            class="text-stone-300 hover:text-red-500 transition-colors">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Botón de Guardado Final -->
                <div class="mt-10 border-t border-stone-100 pt-8">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-[#C56A3D] text-white py-4 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-[#C56A3D]/30 hover:bg-[#A65D3A] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                        <span wire:loading.remove wire:target="save">
                            <i class="fas fa-cloud-upload-alt mr-2"></i> Actualizar Bitácora
                        </span>
                        <span wire:loading wire:target="save" class="flex items-center">
                            <i class="fas fa-spinner fa-spin mr-2"></i> Guardando Cambios...
                        </span>
                    </button>
                    <p class="text-[9px] text-center text-stone-400 mt-4 italic">Al guardar, los cambios se
                        sincronizarán con el servidor central de ArqueoRD.</p>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    input:focus,
    select:focus,
    textarea:focus {
        outline: none !important;
        box-shadow: 0 0 0 4px rgba(197, 106, 61, 0.1) !important;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
