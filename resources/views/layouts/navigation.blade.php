<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="transition-transform hover:scale-105">
                        <x-application-logo class="block h-9 w-auto fill-current text-[#8B5A2B]" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'ministerio')
                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="text-stone-600 hover:text-[#C56A3D] border-[#C56A3D] font-medium transition">
                            <i class="fas fa-users-cog mr-2"></i> Gestión de Personal
                        </x-nav-link>
                        <x-nav-link :href="route('logs.index')" :active="request()->routeIs('logs.index')" class="text-stone-600 hover:text-[#C56A3D] border-[#C56A3D] font-medium transition">
                            <i class="fas fa-compass mr-2"></i> Explorar Bitácoras
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-6">

                <a href="{{ url('/') }}" class="group relative inline-flex items-center justify-center px-5 py-2 text-[10px] font-black uppercase tracking-widest text-white transition-all duration-300 bg-gradient-to-r from-[#C56A3D] to-[#8B5A2B] rounded-full shadow-[0_4px_15px_rgba(197,106,61,0.3)] transform hover:-translate-y-1 hover:shadow-[0_8px_25px_rgba(197,106,61,0.5)] overflow-hidden border border-white/20">
                    <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-20"></span>
                    <i class="fas fa-rocket mr-2 drop-shadow-md group-hover:animate-bounce"></i>
                    <span class="relative drop-shadow-md">Portal Público</span>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-stone-600 bg-white hover:text-[#C56A3D] hover:bg-stone-50 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fas fa-user-circle mr-2 text-stone-400"></i> {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-red-600 hover:text-red-700">
                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-[#C56A3D] hover:bg-stone-100 focus:outline-none focus:bg-stone-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-stone-50 border-b border-stone-200 shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            <div class="px-4 py-4 mb-2">
                <a href="{{ url('/') }}" class="w-full flex items-center justify-center px-4 py-3 text-xs font-black uppercase tracking-widest text-white bg-gradient-to-r from-[#C56A3D] to-[#8B5A2B] rounded-xl shadow-lg transition-transform active:scale-95">
                    <i class="fas fa-rocket mr-2 animate-pulse"></i> Ir al Portal Público
                </a>
            </div>

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-bold">
                <i class="fas fa-chart-pie mr-2 text-stone-400"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'ministerio')
                <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="text-stone-700 font-bold">
                    <i class="fas fa-users-cog mr-2 text-[#C56A3D]"></i> Gestión de Personal
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('logs.index')" :active="request()->routeIs('logs.index')" class="text-stone-700 font-bold">
                    <i class="fas fa-compass mr-2 text-[#C56A3D]"></i> Explorar Bitácoras
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t border-stone-200 bg-white">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 bg-[#1F4E6E] text-white rounded-full flex items-center justify-center font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-base text-stone-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-stone-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fas fa-user-circle mr-2 text-stone-400"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-red-600 font-bold">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
