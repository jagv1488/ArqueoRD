<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $title ?? 'ArqueoRD | Patrimonio Dominicano' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FDF9F2; scroll-behavior: smooth; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
        .card-hover { transition: transform 0.25s ease, box-shadow 0.25s ease; }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 25px -12px rgba(0,0,0,0.1); }
        @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(calc(-250px * 5)); } }
        .slider-track { animation: scroll 30s linear infinite; display: flex; width: calc(250px * 10); }
        .slider-track:hover { animation-play-state: paused; }
    </style>
</head>
<body class="antialiased overflow-x-hidden text-stone-800 flex flex-col min-h-screen">

    <header x-data="{ mobileOpen: false }" class="bg-white/95 backdrop-blur-sm sticky top-0 z-50 border-b border-[#E6DBCB]">
        <div class="container mx-auto px-5 py-3 flex justify-between items-center">

            <a href="{{ url('/') }}" class="group flex items-center gap-3 cursor-pointer transition-all duration-300">
                <div class="relative flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#C56A3D] blur-lg opacity-0 group-hover:opacity-40 rounded-full transition-opacity duration-500"></div>
                    <img src="{{ asset('storage/Logo.svg') }}" alt="Logo ArqueoRD" class="w-10 h-10 md:w-14 md:h-14 transform group-hover:-rotate-6 group-hover:scale-110 transition-all duration-500 ease-out z-10">
                </div>

                <div class="flex flex-col justify-center transform group-hover:translate-x-1 transition-transform duration-500">
                    <div class="font-sans font-black text-2xl md:text-[1.70rem] leading-none tracking-tighter flex items-baseline">
                        <span class="text-[#8B5A2B]">ARQUEO</span>
                        <span class="text-[#1F4E6E]">RD</span>
                    </div>
                    <span class="text-[8px] md:text-[9.5px] font-black tracking-[0.2em] text-black mt-1 uppercase opacity-90 group-hover:opacity-100 transition-opacity">
                        desenterrando el futuro
                    </span>
                </div>
            </a>

            <nav class="hidden md:flex gap-6 items-center text-stone-700 font-medium text-sm">
                <a href="{{ url('/') }}" class="hover:text-[#C56A3D] transition">Inicio</a>
                <a href="{{ route('catalog.index') }}" class="hover:text-[#C56A3D] text-[#1F4E6E] font-bold transition">Catálogo</a>
                <a href="{{ url('/#funciones') }}" class="hover:text-[#C56A3D] transition">Funciones</a>
                <a href="{{ url('/#nuestra-historia') }}" class="hover:text-[#C56A3D] transition">Nuestra Historia</a>
                <a href="{{ route('contacto') }}" class="hover:text-[#C56A3D] transition">Contacto</a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-[#1F4E6E] hover:bg-[#153850] text-white px-5 py-2 rounded-full shadow transition-all flex items-center">
                            <i class="fas fa-chart-line mr-2"></i> Mi Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-[#C56A3D]/10 hover:bg-[#C56A3D]/20 text-[#C56A3D] px-5 py-2 rounded-full transition-all flex items-center font-bold">
                            <i class="fas fa-user-lock mr-2"></i> Acceso
                        </a>
                    @endauth
                @endif
            </nav>

            <div class="md:hidden">
                <button @click="mobileOpen = !mobileOpen" class="text-2xl text-[#8B5A2B]"><i class="fas fa-bars"></i></button>
            </div>
        </div>

        <div x-show="mobileOpen" @click.away="mobileOpen = false" x-transition x-cloak class="md:hidden absolute w-full bg-white border-b shadow-lg z-40">
            <div class="flex flex-col px-5 py-4 space-y-4 text-stone-700">
                <a href="{{ url('/') }}"><i class="fas fa-home text-[#C56A3D] w-5"></i> Inicio</a>
                <a href="{{ route('catalog.index') }}" class="font-bold text-[#1F4E6E]"><i class="fas fa-search text-[#C56A3D] w-5"></i> Catálogo</a>
                <a href="{{ url('/#funciones') }}"><i class="fas fa-cogs text-[#C56A3D] w-5"></i> Funciones</a>
                <a href="{{ url('/#nuestra-historia') }}"><i class="fas fa-robot text-[#C56A3D] w-5"></i> Nuestra Historia</a>
                <a href="{{ route('contacto') }}"><i class="fas fa-envelope text-[#C56A3D] w-5"></i> Contacto</a>
                <hr>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[#1F4E6E] font-bold"><i class="fas fa-chart-line w-5"></i> Mi Panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-[#C56A3D] font-bold"><i class="fas fa-user-lock w-5"></i> Acceso</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-transparent text-stone-700 py-12 mt-auto border-t-4 border-[#C56A3D]">
        <div class="container mx-auto px-5 text-center">
            <img src="{{ asset('storage/Logo.svg') }}" alt="Logo ArqueoRD" class="h-20 mx-auto mb-4 object-contain" onerror="this.style.display='none'">

            <p class="text-sm font-bold uppercase tracking-widest text-[#8B5A2B]">© {{ date('Y') }} ArqueoRD</p>
            <p class="text-xs font-medium mt-1">Bitácora Digital del Patrimonio Arqueológico Dominicano.</p>
            <div class="mt-4 text-[10px] text-stone-500 max-w-xl mx-auto uppercase tracking-tighter opacity-70">
                Desarrollado para la protección y difusión del legado cultural bajo estrictos protocolos de seguridad de datos institucionales.
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
