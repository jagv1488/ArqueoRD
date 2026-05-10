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

        /* EFECTO "DESENTERRAR" PARA LAS TARJETAS DE ESTUDIANTES */
        .card-unearth {
            position: relative;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); /* Efecto de rebote al salir */
            z-index: 1;
        }
        .card-unearth:hover {
            transform: translateY(-10px) scale(1.03) rotate(-1deg);
            box-shadow: 0 20px 25px -5px rgba(197, 106, 61, 0.25), 0 0 0 2px rgba(197, 106, 61, 0.1);
            border-color: #D4A373 !important;
            background-color: #FEFAE0 !important; /* Brillo de arena/oro */
            z-index: 10;
        }
        .card-unearth:hover .name-text {
            color: #8B5A2B !important;
        }

        /* Efecto Especial para la Capitana */
        .card-unearth-dark {
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 1;
        }
        .card-unearth-dark:hover {
            transform: translateY(-12px) scale(1.05) rotate(1deg);
            box-shadow: 0 20px 25px -5px rgba(31, 78, 110, 0.4), 0 0 0 2px rgba(212, 163, 115, 0.4);
            background-color: #112d40 !important;
            border-color: #D4A373 !important;
            z-index: 10;
        }
    </style>

    <section id="inicio"
             x-data="{ mouseX: 0, mouseY: 0 }"
             @mousemove="mouseX = ($event.clientX - (window.innerWidth / 2)) * 0.04; mouseY = ($event.clientY - (window.innerHeight / 2)) * 0.04"
             class="relative bg-gradient-to-r from-[#F3E9DC] to-[#EADBC6] py-20 md:py-28 overflow-hidden">

        <div class="absolute inset-0 bg-dots-pattern opacity-10 pointer-events-none"></div>

        <div class="absolute top-16 left-10 md:left-24 opacity-20 text-[#8B5A2B] animate-float-slow pointer-events-none transition-transform duration-75"
             :style="`transform: translate(${mouseX}px, ${mouseY}px)`">
            <i class="fas fa-book-open text-7xl md:text-9xl drop-shadow-lg"></i>
        </div>
        <div class="absolute bottom-24 right-10 md:right-32 opacity-20 text-[#1F4E6E] animate-float-medium pointer-events-none transition-transform duration-75"
             :style="`transform: translate(${mouseX * -1.5}px, ${mouseY * -1.5}px)`">
            <i class="fas fa-compass text-6xl md:text-8xl drop-shadow-lg"></i>
        </div>

        <div class="container mx-auto px-5 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-md px-5 py-1.5 rounded-full text-[#C56A3D] text-sm mb-6 border border-white shadow-sm animate-pulse">
                        <i class="fas fa-satellite-dish"></i> <span class="font-bold tracking-wide">Sistema de Registro Activo</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl xl:text-7xl font-serif font-bold text-[#8B5A2B] leading-tight mt-2 drop-shadow-sm">
                        Desenterrando el <span class="text-[#C56A3D] relative inline-block">
                            futuro
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-[#C56A3D] opacity-70" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q50,20 100,10" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                        </span>
                    </h1>

                    <p class="text-lg md:text-xl text-stone-700 max-w-xl mx-auto lg:mx-0 mt-6 leading-relaxed font-medium">
                        Plataforma colaborativa para arqueólogos, investigadores y público general. Registra, explora y protege nuestro legado cultural en tiempo real.
                    </p>

                    <div class="flex flex-wrap justify-center lg:justify-start gap-4 mt-10">
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
                </div>

                <div class="relative w-full max-w-xl mx-auto" x-data="{ videoSrc: null }">
                    <div class="absolute -inset-1 bg-gradient-to-r from-[#C56A3D] to-[#1F4E6E] rounded-[2.5rem] blur opacity-40 animate-pulse"></div>

                    <div class="relative bg-stone-900 rounded-[2rem] overflow-hidden shadow-2xl aspect-video border-4 border-white/50 flex items-center justify-center group">

                        <div x-show="!videoSrc" class="text-center p-6 transition-all transform group-hover:scale-105">
                            <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/20 backdrop-blur-sm">
                                <i class="fas fa-play text-3xl text-white pl-1"></i>
                            </div>
                            <h3 class="text-white font-bold text-lg mb-2">Video del Proyecto</h3>

                            <label class="cursor-pointer inline-block bg-[#C56A3D] hover:bg-[#A65D3A] text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition shadow-lg">
                                <i class="fas fa-upload mr-2"></i> Cargar Video
                                <input type="file" accept="video/*" class="hidden" @change="videoSrc = URL.createObjectURL($event.target.files[0])">
                            </label>
                            <p class="text-stone-400 text-[10px] mt-3">Haz clic para previsualizar un video local</p>
                        </div>

                        <template x-if="videoSrc">
                            <div class="w-full h-full relative">
                                <video controls autoplay class="w-full h-full object-cover bg-black" :src="videoSrc"></video>

                                <button @click="videoSrc = null" class="absolute top-4 right-4 bg-black/60 hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center backdrop-blur-md transition z-50">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </template>

                    </div>

                    <div class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 flex gap-3 w-full justify-center">
                        <span class="bg-white text-[#1F4E6E] text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-lg border border-stone-100"><i class="fas fa-robot mr-1"></i> STEAM</span>
                        <span class="bg-white text-[#C56A3D] text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-lg border border-stone-100"><i class="fas fa-award mr-1"></i> FLL Unearthed</span>
                    </div>
                </div>

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

    <section id="nuestra-historia" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#F7EFE2] rounded-bl-full -z-10 opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#EADBC6] rounded-tr-full -z-10 opacity-30"></div>

        <div class="container mx-auto px-5 relative z-10">
            <div class="max-w-4xl mx-auto text-center mb-10">
                <div class="inline-flex items-center justify-center gap-2 bg-[#FDF9F2] border border-[#E6DBCB] px-5 py-2.5 rounded-full mb-6 shadow-sm">
                    <i class="fas fa-school text-[#1F4E6E]"></i>
                    <span class="text-xs font-black uppercase tracking-widest text-[#1F4E6E]">Centro Secundario Prof. Jesús María Fernández</span>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-6 mb-12">
                    <div class="bg-white border border-[#E6DBCB] px-6 py-4 rounded-2xl shadow-sm flex items-center justify-center sm:justify-start gap-4">
                        <div class="w-10 h-10 bg-blue-50 text-[#1F4E6E] rounded-full flex items-center justify-center text-lg">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[9px] font-black uppercase tracking-widest text-stone-400">Directora del Centro</p>
                            <p class="font-bold text-[#1F4E6E]">Juana Elvira Bobadilla Sánchez</p>
                        </div>
                    </div>

                    <div class="bg-white border border-[#E6DBCB] px-6 py-4 rounded-2xl shadow-sm flex items-center justify-center sm:justify-start gap-4">
                        <div class="w-10 h-10 bg-orange-50 text-[#C56A3D] rounded-full flex items-center justify-center text-lg">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[9px] font-black uppercase tracking-widest text-stone-400">Docente Informática Educativa</p>
                            <p class="font-bold text-[#1F4E6E]">Ing. José Antonio Guerrero Vélez</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#8B5A2B] mb-6 leading-tight">
                    De las Aulas al <span class="text-[#C56A3D]">Rescate Patrimonial</span>
                </h2>

                <p class="text-stone-600 text-lg leading-relaxed mb-6">
                    <strong>ArqueoRD</strong> no es solo una plataforma tecnológica; es la respuesta de una nueva generación a la necesidad de preservar nuestra historia. Este proyecto surge desde el corazón del <strong>Club de Robótica y Tecnología</strong> de nuestro centro educativo Prof. Jesús María Fernández en San Francisco de Macorís, integrando pensamiento computacional, metodología STEAM, Asi como tambien Inteligencia Artificial.
                </p>
                <p class="text-stone-600 text-lg leading-relaxed">
                    Nacido como el proyecto de innovación e investigación para la temporada <strong>Unearthed</strong> de la competición internacional <strong>FIRST LEGO League</strong>, ArqueoRD demuestra cómo los jóvenes dominicanos pueden utilizar la tecnología para resolver problemas reales y proteger el legado cultural de la República Dominicana.
                </p>
            </div>

            <div class="mt-20">
                <div class="text-center mb-12">
                    <i class="fas fa-robot text-4xl text-[#C56A3D] mb-4"></i>
                    <h3 class="text-3xl font-serif font-bold text-[#1F4E6E]">Los Arquitectos del Proyecto</h3>
                    <p class="text-stone-500 mt-2 font-medium">Conoce a los 23 brillantes estudiantes detrás de esta innovación.</p>
                </div>

                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <h4 class="text-sm font-black uppercase tracking-widest text-[#8B5A2B] bg-[#FEFAE0] px-4 py-2 rounded-lg border border-[#D4A373]/30">
                            Equipo Oficial de Competencia (FLL)
                        </h4>
                        <div class="flex-grow h-px bg-stone-200"></div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div class="card-unearth-dark bg-[#1F4E6E] border-2 border-[#1F4E6E] text-white p-4 rounded-2xl text-center flex flex-col justify-center min-h-[80px]">
                            <p class="font-bold text-sm leading-tight name-text">Erileidy Gutiérrez Mejía</p>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#D4A373] mt-2">Capitana</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Camila Solís Paulino</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Ianis Mabel Herrera Pichardo</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Sara Esther Acosta Jaime</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Genyeli Cáceres Morel</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Samira Meyreles Pérez</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Hanely Terrero Escaño</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Rust Merlin Paredes Vásquez</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Brander Santos Mejía</p>
                        </div>
                        <div class="card-unearth bg-white border-2 border-stone-100 p-4 rounded-2xl text-center flex items-center justify-center min-h-[80px]">
                            <p class="font-bold text-stone-800 text-xs name-text transition-colors">Yadiel Antonio Ramos Gálvez</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <h4 class="text-sm font-black uppercase tracking-widest text-stone-500 bg-stone-100 px-4 py-2 rounded-lg border border-stone-200">
                            Miembros del Club de Robótica y Tecnología
                        </h4>
                        <div class="flex-grow h-px bg-stone-200"></div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Keysha Taveras Breton</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Leidy Laura Burgos Valdez</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Crismeily Lantigua Burgos</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Jefferson Nazario Español Duarte</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Jankeyris López Melo</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Francheska Meléndez</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Cristal Vásquez</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Ihassely Suarez Hidalgo</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Ashely Arleny Lajara Méndez</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Yuleidi Román Borbon</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Yokairin Jimenez</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Brianna Dequin Martínez</p></div>
                        <div class="card-unearth bg-stone-50 p-3 rounded-xl border border-stone-100 text-center flex items-center justify-center min-h-[60px]"><p class="text-xs font-semibold text-stone-600 leading-tight name-text transition-colors">Rick Andrews Mendez Castillo</p></div>
                    </div>
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


    <section id="patrocinadores" class="py-16 bg-white border-t border-[#E6DBCB] overflow-hidden">
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

    <section id="mini-juego" class="py-24 bg-white border-t border-[#E6DBCB] relative overflow-hidden" x-data="archaeologyGame()">

        <div class="absolute top-0 right-0 w-64 h-64 bg-[#F7EFE2] rounded-bl-full -z-10 opacity-40"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#EADBC6] rounded-tr-full -z-10 opacity-30"></div>

        <div class="container mx-auto px-5 relative z-10 text-center">
            <span class="text-[#C56A3D] font-bold tracking-widest uppercase text-xs"><i class="fas fa-gamepad"></i> Zona Interactiva</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-[#8B5A2B] mt-2 mb-4">Excavación Virtual</h2>
            <p class="text-stone-500 max-w-2xl mx-auto text-lg mb-10">Ponte en los zapatos de un arqueólogo de campo. Tienes una cuadrícula de 5x5 metros. ¿Puedes encontrar los <span class="font-bold text-[#C56A3D]">5 artefactos históricos</span> ocultos bajo la tierra?</p>

            <div class="flex flex-wrap justify-center gap-4 md:gap-8 mb-8">
                <div class="bg-[#FDF9F2] px-6 py-3 rounded-2xl shadow-sm border border-[#E6DBCB] min-w-[160px]">
                    <span class="text-[10px] font-black text-stone-400 uppercase tracking-widest block mb-1">Artefactos</span>
                    <span class="text-3xl font-black text-[#C56A3D]" x-text="found + ' / ' + total"></span>
                </div>
                <div class="bg-[#FDF9F2] px-6 py-3 rounded-2xl shadow-sm border border-[#E6DBCB] min-w-[160px]">
                    <span class="text-[10px] font-black text-stone-400 uppercase tracking-widest block mb-1">Excavaciones</span>
                    <span class="text-3xl font-black text-[#1F4E6E]" x-text="moves"></span>
                </div>
            </div>

            <div class="max-w-md mx-auto bg-[#6B4423] p-3 md:p-5 rounded-[2rem] shadow-inner mb-8">
                <div class="grid grid-cols-5 gap-2 md:gap-3">
                    <template x-for="(cell, index) in grid" :key="index">
                        <button @click="dig(index)"
                                :disabled="cell.revealed || gameOver"
                                :class="{
                                    'bg-[#8B5A2B] hover:bg-[#A65D3A] cursor-pointer shadow-[inset_0_-4px_0_rgba(0,0,0,0.3)] transform active:translate-y-1 active:shadow-none': !cell.revealed,
                                    'bg-[#D4A373] shadow-inner cursor-default': cell.revealed && !cell.hasArtifact,
                                    'bg-[#FEFAE0] shadow-[0_0_15px_rgba(197,106,61,0.6)] cursor-default transform scale-110 z-10 border-2 border-[#C56A3D]': cell.revealed && cell.hasArtifact
                                }"
                                class="w-full aspect-square rounded-xl flex items-center justify-center text-2xl md:text-3xl transition-all duration-300">

                            <div x-show="!cell.revealed" class="w-full h-full opacity-10 rounded-xl" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 8px 8px;"></div>

                            <i x-show="cell.revealed && cell.hasArtifact" :class="'fas ' + cell.icon + ' text-[#C56A3D] drop-shadow-md'" style="display: none;" x-transition.scale.duration.500ms></i>

                            <div x-show="cell.revealed && !cell.hasArtifact" class="w-3/4 h-3/4 rounded-full bg-black/10 shadow-inner" style="display: none;"></div>
                        </button>
                    </template>
                </div>
            </div>

            <div x-show="gameOver" style="display: none;" x-transition.scale class="mb-8 p-8 bg-green-50 border-2 border-green-200 rounded-[2rem] max-w-md mx-auto text-green-800 shadow-lg">
                <div class="animate-bounce mb-4"><i class="fas fa-trophy text-5xl text-yellow-500 drop-shadow-md"></i></div>
                <h3 class="text-2xl font-black mb-2 uppercase tracking-tighter">¡Excavación Exitosa!</h3>
                <p class="text-sm font-medium">Lograste recuperar todos los artefactos históricos realizando <span class="font-black text-lg bg-white px-2 py-1 rounded-md" x-text="moves"></span> excavaciones.</p>
            </div>

            <button @click="initGame()" class="bg-[#1F4E6E] hover:bg-[#153850] text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-lg transition-transform transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-3 mx-auto">
                <i class="fas fa-sync-alt"></i> Generar Nuevo Yacimiento
            </button>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('archaeologyGame', () => ({
                    grid: [],
                    found: 0,
                    total: 5,
                    moves: 0,
                    gameOver: false,
                    // Iconos que simulan: hueso, vasija/gemas, moneda colonial, anillo, corona
                    artifacts: ['fa-bone', 'fa-gem', 'fa-coins', 'fa-ring', 'fa-crown'],

                    init() {
                        this.initGame();
                    },

                    initGame() {
                        this.found = 0;
                        this.moves = 0;
                        this.gameOver = false;
                        this.grid = Array.from({ length: 25 }, () => ({
                            revealed: false,
                            hasArtifact: false,
                            icon: ''
                        }));

                        // Esconder los 5 artefactos aleatoriamente en la cuadrícula
                        let placed = 0;
                        while (placed < this.total) {
                            let randomIndex = Math.floor(Math.random() * 25);
                            if (!this.grid[randomIndex].hasArtifact) {
                                this.grid[randomIndex].hasArtifact = true;
                                this.grid[randomIndex].icon = this.artifacts[placed];
                                placed++;
                            }
                        }
                    },

                    dig(index) {
                        if (this.gameOver || this.grid[index].revealed) return;

                        this.grid[index].revealed = true;
                        this.moves++; // Contar el intento

                        if (this.grid[index].hasArtifact) {
                            this.found++; // Sumar al marcador si es un artefacto
                            if (this.found === this.total) {
                                this.gameOver = true; // Fin del juego
                            }
                        }
                    }
                }));
            });
        </script>
    </section>

    <section id="tecnologias" class="py-16 bg-white border-t border-[#E6DBCB]">
        <div class="container mx-auto px-5 text-center">
            <h3 class="text-xs font-black uppercase tracking-widest text-stone-400 mb-10">Desarrollado con Tecnologías de Vanguardia</h3>

            <div class="flex flex-wrap justify-center items-center gap-10 md:gap-16 opacity-80 hover:opacity-100 transition-opacity duration-300">
                <div class="flex flex-col items-center gap-3 group">
                    <i class="fab fa-laravel text-4xl text-[#FF2D20] group-hover:scale-110 transition-transform duration-300 drop-shadow-sm"></i>
                    <span class="text-[10px] font-bold text-stone-500 uppercase tracking-wider group-hover:text-[#FF2D20] transition-colors">Laravel</span>
                </div>

                <div class="flex flex-col items-center gap-3 group">
                    <i class="fas fa-wind text-4xl text-[#38B2AC] group-hover:scale-110 transition-transform duration-300 drop-shadow-sm"></i>
                    <span class="text-[10px] font-bold text-stone-500 uppercase tracking-wider group-hover:text-[#38B2AC] transition-colors">Tailwind CSS</span>
                </div>

                <div class="flex flex-col items-center gap-3 group">
                    <i class="fas fa-code text-4xl text-[#77C1D2] group-hover:scale-110 transition-transform duration-300 drop-shadow-sm"></i>
                    <span class="text-[10px] font-bold text-stone-500 uppercase tracking-wider group-hover:text-[#77C1D2] transition-colors">Alpine.js</span>
                </div>

                <div class="flex flex-col items-center gap-3 group">
                    <i class="fas fa-database text-4xl text-[#00758F] group-hover:scale-110 transition-transform duration-300 drop-shadow-sm"></i>
                    <span class="text-[10px] font-bold text-stone-500 uppercase tracking-wider group-hover:text-[#00758F] transition-colors">MySQL</span>
                </div>

                <div class="flex flex-col items-center gap-3 group">
                    <i class="fas fa-star text-4xl text-[#8E44AD] group-hover:scale-110 transition-transform duration-300 drop-shadow-sm"></i>
                    <span class="text-[10px] font-bold text-stone-500 uppercase tracking-wider group-hover:text-[#8E44AD] transition-colors">Gemini IA</span>
                </div>
            </div>
        </div>
    </section>

</x-layouts.public>
