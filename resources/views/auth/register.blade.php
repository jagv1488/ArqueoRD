<x-guest-layout>
    <div class="flex h-screen bg-white overflow-hidden">
        <div class="hidden lg:flex lg:w-2/5 relative bg-[#8B5A2B]">
            <div class="absolute inset-0 bg-gradient-to-br from-[#8B5A2B]/90 to-[#1F4E6E]/70 z-10"></div>
            <img src="{{ asset('registerbackground.png') }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="relative z-20 flex flex-col justify-center px-10 text-white">
                <h1 class="text-4xl font-serif font-bold leading-tight">Protege el <br><span class="text-[#FEFAE0]">Legado</span></h1>
                <p class="mt-4 text-sm text-white/80 border-l-2 border-[#FEFAE0] pl-4 italic">Sistema Nacional de Registro Arqueológico.</p>
            </div>
        </div>

        <div class="w-full lg:w-3/5 flex items-center justify-center p-6 md:p-12 bg-[#FDFCFB]">
            <div class="w-full max-w-xl">

                <div class="mb-8 flex justify-center lg:justify-start">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-[9px] font-black uppercase tracking-widest text-stone-500 hover:text-[#C56A3D] transition-all bg-white hover:bg-[#FDF9F2] py-2.5 px-5 rounded-full border border-stone-200 hover:border-[#D4A373]/50 shadow-sm group">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i> Volver al Portal Público
                    </a>
                </div>

                <div class="mb-6 flex justify-between items-end">
                    <div>
                        <span class="text-xl font-black text-[#1F4E6E] uppercase tracking-tighter">Arqueo<span class="text-[#C56A3D]">RD</span></span>
                        <h2 class="text-2xl font-serif font-bold text-[#8B5A2B] mt-1 leading-none">Nueva Solicitud</h2>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" x-data="{ loading: false }" @submit="loading = true" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-3">
                        <div>
                            <x-input-label for="name" value="Nombre Completo" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="name" class="block w-full px-3 py-2 border-stone-200 rounded-xl text-xl font-bold" type="text" name="name" required autofocus />
                        </div>
                        <div>
                            <x-input-label for="license_number" value="N° Matrícula (ARQ-XXXX)" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="license_number" class="block w-full px-3 py-2 border-stone-200 rounded-xl text-xl font-bold" type="text" name="license_number" required />
                        </div>
                        <div>
                            <x-input-label for="institution" value="Institución / Universidad" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="institution" class="block w-full px-3 py-2 border-stone-200 rounded-xl text-xl font-bold" type="text" name="institution" required />
                        </div>
                        <div>
                            <x-input-label for="email" value="Correo Institucional" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="email" class="block w-full px-3 py-2 border-stone-200 rounded-xl text-xl font-bold" type="email" name="email" required />
                        </div>
                        <div>
                            <x-input-label for="password" value="Contraseña" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="password" class="block w-full px-3 py-2 border-stone-200 rounded-xl text-xl" type="password" name="password" required />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" value="Confirmar Contraseña" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest mb-1 ml-1" />
                            <x-text-input id="password_confirmation" class="block w-full px-3 py-2 border-stone-200 rounded-xl text-xl" type="password" name="password_confirmation" required />
                        </div>
                    </div>

                    <div class="p-3 bg-[#FEFAE0]/40 border border-[#D4A373]/20 rounded-xl">
                        <label for="terms" class="flex items-start cursor-pointer group">
                            <input id="terms" type="checkbox" class="rounded border-stone-300 text-[#C56A3D] w-4 h-4 mt-0.5" name="terms" required>
                            <span class="ms-3 text-[9.9px] text-stone-600 font-bold uppercase tracking-tight leading-tight">
                                Acepto los términos y declaro veracidad en mis datos técnicos.
                            </span>
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                        <button type="submit" class="w-full sm:w-2/3 bg-[#C56A3D] hover:bg-[#A65D3A] text-white font-black text-[10px] uppercase tracking-[0.2em] py-3.5 rounded-xl transition-all shadow-lg transform active:scale-95" :class="{ 'opacity-75': loading }" :disabled="loading">
                            Registrar Solicitud <i class="fas fa-paper-plane ml-1 text-[8px]"></i>
                        </button>
                        <a href="{{ route('login') }}" class="w-full sm:w-1/3 text-stone-500 font-black text-[9.9px] uppercase tracking-widest text-center hover:text-[#C56A3D] transition-colors">
                            Ya tengo cuenta
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
