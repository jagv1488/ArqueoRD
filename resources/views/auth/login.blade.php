<x-guest-layout>
    <div class="flex h-screen bg-white overflow-hidden">
        <!-- LADO IZQUIERDO: Imagen (50% de la pantalla) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#1F4E6E]">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1F4E6E]/80 to-[#8B5A2B]/60 z-10"></div>
            <img src="https://images.unsplash.com/photo-1599408162165-8b8267b4f31d?auto=format&fit=crop&q=80"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="relative z-20 flex flex-col justify-center px-12 text-white">
                <span class="bg-[#C56A3D] text-white px-3 py-1 rounded-full text-[9.9px] font-black uppercase tracking-widest w-fit mb-4">
                    Patrimonio Nacional
                </span>
                <h1 class="text-4xl xl:text-6xl font-serif font-bold leading-tight">
                    Desenterrando <br>el <span class="text-[#FEFAE0]">futuro</span>
                </h1>
                <p class="mt-4 text-lg text-white/90 border-l-4 border-[#C56A3D] pl-4 italic max-w-sm">
                    Gestión digital del patrimonio cultural dominicano.
                </p>
            </div>
        </div>

        <!-- LADO DERECHO: Formulario -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-[#FDFCFB]">
            <div class="w-full max-w-sm">
                <div class="mb-6 text-center lg:text-left">
                    <span class="text-2xl font-black text-[#1F4E6E] uppercase tracking-tighter">Arqueo<span class="text-[#C56A3D]">RD</span></span>
                    <h2 class="text-2xl font-serif font-bold text-[#8B5A2B] mt-2">Acceso al Panel</h2>
                </div>

                <!-- CREDENCIALES REDUCIDAS -->
                <div class="mb-5 p-3 bg-[#FEFAE0] border border-[#D4A373]/30 rounded-xl">
                    <p class="text-[9.9px] text-stone-700 font-bold  tracking-widest">
                        <i class="fas fa-user mr-1"></i> Admin: <span class="text-[#1F4E6E] font-black lowercase">admin@arqueord.com.do</span>
                    </p>
                    <p class="text-[9.9px] text-stone-700 font-bold tracking-widest">
                        <i class="fas fa-unlock mr-1"></i> Clave: <span class="text-[#1F4E6E] font-black">password123</span>
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" @submit="loading = true">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="email" value="Email Institucional" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest mb-1 ml-1" />
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-300">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <x-text-input id="email" class="block w-full pl-9 py-2.5 border-stone-200 rounded-xl text-xl font-bold" type="email" name="email" required autofocus />
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-1 ml-1">
                                <x-input-label for="password" value="Contraseña" class="text-[9.9px] font-black text-stone-400 uppercase tracking-widest" />
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-300">
                                    <i class="fas fa-lock text-xl"></i>
                                </div>
                                <x-text-input id="password" class="block w-full pl-9 py-2.5 border-stone-200 rounded-xl text-xl font-bold" type="password" name="password" required />
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <button type="submit" class="w-full bg-[#1F4E6E] hover:bg-[#153850] text-white font-black text-[10px] uppercase tracking-[0.2em] py-3.5 rounded-xl transition-all transform active:scale-95 flex justify-center items-center gap-2">
                            <span x-show="!loading">Ingresar <i class="fas fa-arrow-right text-[9.9px]"></i></span>
                            <span x-show="loading" x-cloak><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                        <a href="{{ route('register') }}" class="w-full bg-white border border-stone-200 text-stone-600 font-black text-[10px] uppercase tracking-[0.2em] py-3.5 rounded-xl flex justify-center items-center hover:bg-stone-50 transition-all">
                            Registro de Arqueólogo
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
