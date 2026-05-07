<x-layouts.public>
    <x-slot name="title">ArqueoRD | Desenterrando el futuro</x-slot>

    <style>
        /* Animaciones personalizadas para la sección Hero */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(6deg); }
        }
        @keyframes float-medium {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-4deg); }
        }
        .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
        .animate-float-medium { animation: float-medium 6s ease-in-out infinite; }

        /* Patrón de puntos para el fondo */
        .bg-dots-pattern {
            background-image: radial-gradient(#C56A3D 1.5px, transparent 1.5px);
            background-size: 35px 35px;
        }
    </style>

    <section id="inicio"
             x-data="{ mouseX: 0, mouseY: 0 }"
             @mousemove="mouseX = ($event.clientX - (window.innerWidth / 2)) * 0.04; mouseY = ($event.clientY - (window.innerHeight / 2)) * 0.04"
             class="relative bg-gradient-to-r from-[#F3E9DC] to-[#EADBC6] py-20 md:py-32 overflow-hidden">

        <div class="absolute inset-0 bg-dots-pattern opacity-10 pointer-events-none"></div>

        <div class="absolute top-16 left-10 md:left-24 opacity-20 text-[#8B5A2B] animate-float-slow pointer-events-none transition-transform duration-75"
             :style="`transform: translate(${mouseX}px, ${mouseY}px)`">
            <i class="fas fa-book-open text-7xl md:text-9xl drop-shadow-lg"></i>
        </div>

        <div class="absolute bottom-24 right-10 md:right-32 opacity-20 text-[#1F4E6E] animate-float-medium pointer-events-none transition-transform duration-75"
             :style="`transform: translate(${mouseX * -1.5}px, ${mouseY * -1.5}px)`">
            <i class="fas fa-compass text-6xl md:text-8xl drop-shadow-lg"></i>
        </div>

        <div class="absolute top-32 right-16 md:right-48 opacity-15 text-[#C56A3D] animate-float-slow pointer-events-none transition-transform duration-75"
             :style="`transform: translate(${mouseX * 0.8}px, ${mouseY * -0.8}px) rotate(15deg)`">
            <i class="fas fa-map-marked-alt text-5xl md:text-7xl drop-shadow-lg"></i>
        </div>

        <div class="absolute bottom-32 left-16 md:left-48 opacity-15 text-[#8B5A2B] animate-float-medium pointer-events-none transition-transform duration-75"
             :style="`transform: translate(${mouseX * -0.5}px, ${mouseY * 0.8}px) rotate(-15deg)`">
            <i class="fas fa-search-location text-5xl md:text-7xl drop-shadow-lg"></i>
        </div>
        <div class="container mx-auto px-5 text-center relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-md px-5 py-1.5 rounded-full text-[#C56A3D] text-sm mb-6 border border-white shadow-sm animate-pulse">
                <i class="fas fa-satellite-dish"></i> <span class="font-bold tracking-wide">Sistema de Registro Activo</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-serif font-bold text-[#8B5A2B] leading-tight mt-2 drop-shadow-sm">
                Desenterrando el <span class="text-[#C56A3D] relative inline-block">
                    futuro
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-[#C56A3D] opacity-70" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q50,20 100,10" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                </span>
            </h1>

            <p class="text-lg md:text-xl text-stone-700 max-w-2xl mx-auto mt-6 leading-relaxed font-medium">
                Plataforma colaborativa para arqueólogos, investigadores y público general. Registra, explora y protege nuestro legado cultural en tiempo real.
            </p>

            <div class="flex flex-wrap justify-center gap-4 mt-10">
                <a href="{{ route('catalog.index') }}"
                    class="bg-[#C56A3D] hover:bg-[#A65D3A] text-white px-8 py-4 rounded-full shadow-[0_10px_20px_rgba(197,106,61,0.3)] font-bold flex items-center gap-2 transition-all transform hover:-translate-y-1 hover:scale-105">
                    <i class="fas fa-search"></i> Explorar Catálogo
                </a>

                @guest
                    <a href="{{ route('register') }}" class="bg-white text-[#1F4E6E] hover:bg-[#1F4E6E] hover:text-white border-2 border-white px-8 py-4 rounded-full font-bold shadow-lg transition-all transform hover:-translate-y-1 hover:scale-105 flex items-center justify-center">
                        <i class="fas fa-user-tag mr-2"></i> Acceso Profesionales
                    </a>
                @endguest
            </div>

            <div class="mt-14 flex justify-center flex-wrap gap-8 text-stone-600 text-sm font-bold bg-white/40 backdrop-blur-sm inline-flex mx-auto px-8 py-3 rounded-2xl border border-white/50 shadow-sm">
                <span class="flex items-center gap-2"><i class="fas fa-database text-[#C56A3D] text-lg"></i> Datos Encriptados</span>
                <span class="flex items-center gap-2"><i class="fas fa-shield-alt text-[#C56A3D] text-lg"></i> Acceso Controlado</span>
                <span class="flex items-center gap-2"><i class="fas fa-map-pin text-[#C56A3D] text-lg"></i> Coordenadas Ocultas</span>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 md:h-16">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

<section id="buscador" class="py-20 bg-white relative overflow-hidden">
                <div class="container mx-auto px-5 relative z-10 text-center">
                    <i class="fas fa-search-location text-5xl text-[#C56A3D] mb-6 opacity-80"></i>
                    <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#8B5A2B] mb-4">El Archivo Nacional</h2>
                    <p class="text-stone-500 max-w-xl mx-auto text-lg mb-10">Busca entre cientos de piezas arqueológicas registradas. Escribe un material, provincia o nombre de yacimiento.</p>

                    <form action="{{ route('catalog.index') }}" method="GET" class="max-w-2xl mx-auto relative group">
                        <input type="text" name="q" placeholder="Ej. 'Cerámica', 'La Vega', 'Hacha'..."
                            class="w-full pl-8 pr-36 py-5 rounded-full border-2 border-stone-200 bg-stone-50 shadow-inner focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/20 text-stone-700 transition-all text-lg md:text-xl" required>
                        <button type="submit" class="absolute right-2 top-2 bottom-2 bg-[#1F4E6E] hover:bg-[#153850] text-white px-6 md:px-8 rounded-full font-bold shadow-md transition-transform transform group-hover:scale-105 flex items-center">
                            Buscar <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </form>

                    <div class="mt-8 flex justify-center gap-3 flex-wrap">
                        <span class="text-sm font-bold text-stone-400 mt-1">Populares:</span>
                        <a href="{{ route('catalog.index', ['q' => 'Taino']) }}" class="text-sm text-[#C56A3D] hover:bg-[#C56A3D] hover:text-white transition bg-[#FDF9F2] px-4 py-1 rounded-full border border-[#E6DBCB]">Taíno</a>
                        <a href="{{ route('catalog.index', ['q' => 'Lítico']) }}" class="text-sm text-[#C56A3D] hover:bg-[#C56A3D] hover:text-white transition bg-[#FDF9F2] px-4 py-1 rounded-full border border-[#E6DBCB]">Lítico</a>
                        <a href="{{ route('catalog.index', ['q' => 'Colonial']) }}" class="text-sm text-[#C56A3D] hover:bg-[#C56A3D] hover:text-white transition bg-[#FDF9F2] px-4 py-1 rounded-full border border-[#E6DBCB]">Colonial</a>
                    </div>
                </div>
            </section>

    <section id="funciones" class="py-24 bg-[#FDF9F2] border-t border-[#E6DBCB]">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-[#C56A3D] font-bold tracking-widest uppercase text-xs"><i class="fas fa-cogs"></i> Potencia Tecnológica</span>
                <h2 class="text-4xl font-serif font-bold text-[#8B5A2B] mt-2">Herramientas para Profesionales</h2>
                <p class="text-stone-500 max-w-2xl mx-auto mt-4">ArqueoRD digitaliza y asegura el trabajo de campo, conectando descubrimientos con el Ministerio de Cultura al instante.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[#E6DBCB] card-hover">
                    <div class="w-14 h-14 bg-blue-50 text-[#1F4E6E] rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-inner">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Seguridad y Encriptación</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Protección estricta de coordenadas geográficas y datos técnicos. Sistema blindado contra el saqueo de patrimonio (huaqueo).</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[#E6DBCB] card-hover">
                    <div class="w-14 h-14 bg-orange-50 text-[#C56A3D] rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-inner">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Mapeo Geoespacial</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Registro exacto de latitud, longitud, nivel de amenaza y estratigrafía, visible exclusivamente para el Ministerio de Cultura.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[#E6DBCB] card-hover">
                    <div class="w-14 h-14 bg-stone-100 text-[#8B5A2B] rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-inner">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Reportes Oficiales</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Generación automática de fichas técnicas en formato PDF listas para imprimir, firmar y entregar formalmente a las autoridades.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[#E6DBCB] card-hover">
                    <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-inner">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Difusión Cultural</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Catálogo público automatizado que permite a estudiantes y ciudadanos explorar el patrimonio sin exponer información sensible.</p>
                </div>
            </div>
        </div>
    </section>
  <section id="newsletter" class="py-20 bg-[#1F4E6E] relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        <div class="container mx-auto px-5 relative z-10 text-center">
            <i class="fas fa-envelope-open-text text-5xl text-[#C56A3D] mb-6"></i>
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4">Descubrimientos en tu bandeja de entrada</h2>
            <p class="text-blue-100 max-w-xl mx-auto mb-8">Suscríbete a nuestro boletín digital para recibir noticias sobre las últimas excavaciones, exposiciones y actualizaciones del patrimonio arqueológico.</p>

            <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Tu correo electrónico..." class="flex-grow px-5 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#C56A3D] text-stone-800" required>
                <button type="submit" class="bg-[#C56A3D] hover:bg-[#A65D3A] text-white px-6 py-3 rounded-xl font-bold transition shadow-lg whitespace-nowrap">
                    Suscribirme
                </button>
            </form>
            <p class="text-xs text-blue-200 mt-4 opacity-70"><i class="fas fa-lock"></i> No enviamos spam. Puedes darte de baja cuando quieras.</p>
        </div>
    </section>
    <section id="patrocinadores" class="py-16 bg-white border-y border-[#E6DBCB] overflow-hidden">
        <div class="container mx-auto px-5 mb-8 text-center">
            <p class="text-stone-400 font-bold uppercase tracking-widest text-xs">Con el respaldo institucional de</p>
        </div>

        <div class="w-full relative mx-auto overflow-hidden">
            <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-white to-transparent z-10"></div>

            <div class="slider-track flex items-center gap-8 px-4">
                @for ($i = 0; $i < 2; $i++)
                    <div class="w-[250px] flex-shrink-0 flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-300 opacity-60 hover:opacity-100">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-landmark text-4xl text-[#1F4E6E]"></i>
                            <span class="font-serif font-bold text-stone-800 leading-tight">Ministerio de <br>Cultura</span>
                        </div>
                    </div>
                    <div class="w-[250px] flex-shrink-0 flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-300 opacity-60 hover:opacity-100">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-university text-4xl text-[#8B5A2B]"></i>
                            <span class="font-serif font-bold text-stone-800 leading-tight">Museo del Hombre <br>Dominicano</span>
                        </div>
                    </div>
                    <div class="w-[250px] flex-shrink-0 flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-300 opacity-60 hover:opacity-100">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-4xl text-[#1F4E6E]"></i>
                            <span class="font-serif font-bold text-stone-800 leading-tight">Universidad <br>UASD</span>
                        </div>
                    </div>
                    <div class="w-[250px] flex-shrink-0 flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-300 opacity-60 hover:opacity-100">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-monument text-4xl text-[#C56A3D]"></i>
                            <span class="font-serif font-bold text-stone-800 leading-tight">Patrimonio <br>Monumental</span>
                        </div>
                    </div>
                    <div class="w-[250px] flex-shrink-0 flex items-center justify-center p-4 grayscale hover:grayscale-0 transition duration-300 opacity-60 hover:opacity-100">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-microscope text-4xl text-stone-600"></i>
                            <span class="font-serif font-bold text-stone-800 leading-tight">Instituto de <br>Investigación</span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>



</x-layouts.public>
