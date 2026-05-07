<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl border border-[#E6DBCB] overflow-hidden">

    <!-- Indicador de Progreso ArqueoRD -->
    <div class="bg-[#FDF9F2] px-8 py-6 border-b border-[#E6DBCB]">
        <div class="flex items-center justify-between">
            @php $steps = [1 => 'Sitio', 2 => 'Geoespacial', 3 => 'Inventario', 4 => 'Evidencia']; @endphp
            @foreach ($steps as $num => $label)
                <div class="flex flex-col items-center flex-1">
                    <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-black shadow-sm transition-all duration-500
                        {{ $currentStep >= $num ? 'bg-[#1F4E6E] text-white rotate-3' : 'bg-stone-200 text-stone-500' }}">
                        {{ $num }}
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest mt-2 {{ $currentStep >= $num ? 'text-[#1F4E6E]' : 'text-stone-400' }}">
                        {{ $label }}
                    </span>
                </div>
                @if ($num < 4)
                    <div class="flex-1 h-1 mx-2 rounded-full {{ $currentStep > $num ? 'bg-[#BC6C25]' : 'bg-stone-200' }}"></div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="p-8 md:p-12">
        <!-- PASO 1: YACIMIENTO -->
        @if ($currentStep == 1)
            <div class="animate-fade-in space-y-6">
                <h3 class="text-2xl font-serif font-bold text-[#8B5A2B] mb-6 flex items-center">
                    <i class="fas fa-map-marked-alt mr-3 text-[#C56A3D]"></i> Información del Yacimiento
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Nombre Oficial *</label>
                        <input type="text" wire:model="site_name" class="w-full rounded-2xl border-stone-200 bg-stone-50 focus:border-[#C56A3D] focus:ring-[#C56A3D]/20 transition-all font-bold">
                        @error('site_name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Provincia *</label>
                        <input type="text" wire:model="province" list="provincias" class="w-full rounded-2xl border-stone-200 bg-stone-50 font-bold">
                        <datalist id="provincias">
                            <option value="Azua"><option value="Barahona"><option value="Dajabón"><option value="Duarte"><option value="La Vega"><option value="Santiago">
                        </datalist>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-stone-500 uppercase tracking-widest mb-2 ml-1">Descripción Pública *</label>
                        <textarea wire:model="site_public_description" rows="3" class="w-full rounded-2xl border-stone-200 bg-stone-50 text-sm italic"></textarea>
                    </div>
                </div>
            </div>
        @endif

        <!-- PASO 2: GEOESPACIAL -->
        @if ($currentStep == 2)
            <div class="animate-fade-in">
                <h3 class="text-2xl font-serif font-bold text-[#8B5A2B] mb-6 flex items-center">
                    <i class="fas fa-satellite-dish mr-3 text-[#C56A3D] animate-pulse"></i> Control Geoespacial
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <input type="number" step="any" wire:model="latitude" placeholder="Latitud" class="rounded-2xl border-stone-200 bg-red-50/30 font-mono">
                    <input type="number" step="any" wire:model="longitude" placeholder="Longitud" class="rounded-2xl border-stone-200 bg-red-50/30 font-mono">
                    <input type="text" wire:model="elevation" placeholder="Elevación" class="rounded-2xl border-stone-200 bg-stone-50">
                    <div class="md:col-span-3 py-6 bg-stone-50 rounded-3xl border px-8">
                        <label class="block text-xs font-black text-[#BC6C25] uppercase tracking-widest mb-4">Nivel de Amenaza *</label>
                        <div class="flex gap-8">
                            <label class="flex items-center gap-2"><input type="radio" wire:model="threat_level" value="low"> <span class="text-sm font-bold">Bajo</span></label>
                            <label class="flex items-center gap-2"><input type="radio" wire:model="threat_level" value="medium"> <span class="text-sm font-bold">Medio</span></label>
                            <label class="flex items-center gap-2"><input type="radio" wire:model="threat_level" value="high"> <span class="text-sm font-bold">Alto</span></label>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- PASO 3: INVENTARIO (DINÁMICO) -->
        @if ($currentStep == 3)
            <div class="animate-fade-in">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-serif font-bold text-[#8B5A2B]"><i class="fas fa-cubes mr-3 text-[#C56A3D]"></i> Inventario de Artefactos</h3>
                    <button type="button" wire:click="addDiscovery" class="bg-[#1F4E6E] text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-md">
                        <i class="fas fa-plus-circle mr-2"></i> Añadir Pieza
                    </button>
                </div>

                <div class="space-y-8">
                    @foreach ($discoveries as $index => $discovery)
                        <div class="p-6 md:p-8 border-2 border-stone-100 rounded-[2.5rem] bg-stone-50/50 relative group transition-all hover:border-[#D4A373]/30">
                            @if (count($discoveries) > 1)
                                <button type="button" wire:click="removeDiscovery({{ $index }})" class="absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full shadow-lg flex items-center justify-center">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">Nombre de la Pieza *</label>
                                    <input type="text" wire:model="discoveries.{{ $index }}.name" class="w-full rounded-xl border-stone-200 text-sm font-bold text-[#1F4E6E]">
                                    @error("discoveries.$index.name") <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-[10px] font-black text-[#BC6C25] uppercase tracking-widest mb-1">Nota Técnica / Contexto de Hallazgo</label>
                                    <textarea wire:model="discoveries.{{ $index }}.private_notes" rows="2" class="w-full rounded-xl border-stone-200 text-xs italic bg-white" placeholder="Describa el contexto estratigráfico..."></textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">Material *</label>
                                    <select wire:model="discoveries.{{ $index }}.material_category" class="w-full rounded-xl border-stone-200 text-xs font-bold">
                                        <option value="">Seleccione...</option>
                                        <option value="Cerámico">Cerámico</option>
                                        <option value="Lítico">Lítico</option>
                                        <option value="Óseo">Óseo</option>
                                        <option value="Metálico">Metálico</option>
                                    </select>
                                    @error("discoveries.$index.material_category") <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">Profundidad (cm)</label>
                                    <input type="number" wire:model="discoveries.{{ $index }}.depth_cm" class="w-full rounded-xl border-stone-200 text-xs font-mono font-bold">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- PASO 4: EVIDENCIA -->
        @if ($currentStep == 4)
            <div class="animate-fade-in text-center space-y-6">
                <div class="w-20 h-20 bg-[#FEFAE0] rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-inner">
                    <i class="fas fa-camera-retro text-3xl text-[#BC6C25]"></i>
                </div>
                <h3 class="text-2xl font-serif font-bold text-[#8B5A2B]">Evidencia Multimedia</h3>
                <div class="border-4 border-dashed border-stone-100 rounded-[3rem] p-12 bg-stone-50/50 relative group">
                    <input type="file" wire:model="attachments" multiple class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <div class="space-y-3">
                        <i class="fas fa-cloud-upload-alt text-5xl text-[#1F4E6E] group-hover:scale-110 transition-transform"></i>
                        <p class="font-black text-[#283618] uppercase tracking-widest text-xs">Click o Arrastra para subir</p>
                    </div>
                </div>
                @if ($attachments)
                    <div class="mt-8 text-left grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($attachments as $attachment)
                            <div class="bg-white border p-3 rounded-2xl flex items-center gap-3 shadow-sm truncate">
                                <i class="fas fa-file-alt text-stone-300"></i>
                                <span class="text-[10px] font-bold text-stone-600 truncate">{{ $attachment->getClientOriginalName() }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Barra de Navegación -->
    <div class="bg-stone-50 px-10 py-6 border-t flex justify-between items-center">
        @if ($currentStep > 1)
            <button wire:click="previousStep" class="px-6 py-3 rounded-2xl text-stone-500 bg-white border font-black text-[10px] uppercase tracking-widest transition-all">Anterior</button>
        @else
            <div></div>
        @endif

        @if ($currentStep < 4)
            <button wire:click="nextStep" class="px-8 py-3 rounded-2xl text-white bg-[#1F4E6E] hover:bg-[#153850] font-black text-[10px] uppercase tracking-widest shadow-lg transition-all transform hover:-translate-y-1">Siguiente</button>
        @else
            <button wire:click="submit" wire:loading.attr="disabled" class="px-10 py-4 rounded-2xl text-white bg-[#C56A3D] hover:bg-[#A65D3A] font-black text-[10px] uppercase tracking-widest shadow-xl flex items-center gap-3 transition-all">
                <span wire:loading.remove wire:target="submit">Finalizar Registro</span>
                <span wire:loading wire:target="submit"><i class="fas fa-spinner fa-spin"></i> Guardando...</span>
            </button>
        @endif
    </div>
</div>
