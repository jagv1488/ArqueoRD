<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-serif font-bold text-2xl text-[#8B5A2B] leading-tight">
                Panel de Control
            </h2>

            <a href="{{ route('log.create') }}" class="bg-[#C56A3D] hover:bg-[#A65D3A] text-white px-5 py-2.5 rounded-xl shadow-md font-bold text-sm transition-all transform hover:-translate-y-1 flex items-center gap-2 w-fit">
                <i class="fas fa-plus-circle"></i> Nuevo Registro
            </a>
        </div>
    </x-slot>

    @php
        $user = auth()->user();
        $isAdmin = in_array($user->role, ['admin', 'ministerio']);

        // Dependiendo del rol, traemos datos globales o personales
        if ($isAdmin) {
            $totalSites = \App\Models\Site::count();
            $totalDiscoveries = \App\Models\Discovery::count();
            $pendingSites = \App\Models\Site::where('status', '!=', 'approved')->count();
            $recentLogs = \App\Models\Site::with('user')->latest()->take(5)->get();
        } else {
            $totalSites = \App\Models\Site::where('user_id', $user->id)->count();
            // Contar piezas que pertenecen a los sitios de este usuario
            $totalDiscoveries = \App\Models\Discovery::whereHas('site', function($q) use($user) {
                $q->where('user_id', $user->id);
            })->count();
            $pendingSites = \App\Models\Site::where('user_id', $user->id)->where('status', '!=', 'approved')->count();
            $recentLogs = \App\Models\Site::where('user_id', $user->id)->latest()->take(5)->get();
        }
    @endphp

    <div class="py-12 bg-[#FDF9F2] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(!$user->is_verified && $user->role === 'archaeologist')
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-5 rounded-r-2xl shadow-sm flex items-start gap-4">
                <div class="mt-0.5">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-yellow-800 uppercase tracking-wide">Cuenta en proceso de verificación</h3>
                    <p class="mt-1 text-sm text-yellow-700 leading-relaxed">
                        Tu matrícula (<strong>{{ $user->license_number ?? 'N/D' }}</strong>) está siendo validada por el Ministerio de Cultura. Actualmente tienes acceso de lectura limitado. Una vez verificado, podrás registrar nuevas bitácoras de campo.
                    </p>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E6DBCB] hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-stone-500 text-xs font-bold uppercase tracking-wider mb-1">
                                {{ $isAdmin ? 'Bitácoras Globales' : 'Mis Bitácoras' }}
                            </p>
                            <h3 class="text-4xl font-bold text-[#1F4E6E]">{{ $totalSites }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-[#1F4E6E]/10 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-map-marked-alt text-2xl text-[#1F4E6E]"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E6DBCB] hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-stone-500 text-xs font-bold uppercase tracking-wider mb-1">
                                {{ $isAdmin ? 'Piezas Totales' : 'Mis Artefactos' }}
                            </p>
                            <h3 class="text-4xl font-bold text-[#8B5A2B]">{{ $totalDiscoveries }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-[#8B5A2B]/10 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-vihara text-2xl text-[#8B5A2B]"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E6DBCB] hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-stone-500 text-xs font-bold uppercase tracking-wider mb-1">En Revisión</p>
                            <h3 class="text-4xl font-bold text-[#C56A3D]">{{ $pendingSites }}</h3>
                        </div>
                        <div class="w-14 h-14 bg-[#C56A3D]/10 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-clipboard-check text-2xl text-[#C56A3D]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-[#E6DBCB]">
                <div class="p-6 sm:p-8">
                    <h3 class="text-xl font-serif font-bold text-[#1F4E6E] border-b border-stone-100 pb-4 mb-6 flex items-center">
                        <i class="fas fa-history text-[#C56A3D] mr-3"></i> Actividad Reciente
                    </h3>

                    @if($recentLogs->isEmpty())
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-[#FDF9F2] rounded-full mb-5 border border-[#E6DBCB]">
                                <i class="fas fa-folder-open text-4xl text-[#C56A3D] opacity-80"></i>
                            </div>
                            <h4 class="text-2xl font-serif font-bold text-[#8B5A2B]">Aún no hay registros</h4>
                            <p class="mt-2 text-stone-500 max-w-sm mx-auto text-sm leading-relaxed">
                                {{ $isAdmin ? 'Ningún arqueólogo ha subido bitácoras al sistema todavía.' : 'Comienza a documentar yacimientos, coordenadas y artefactos utilizando el sistema de registro seguro.' }}
                            </p>

                            @if(!$isAdmin)
                            <a href="{{ route('log.create') }}" class="mt-8 inline-flex bg-white border-2 border-[#1F4E6E] text-[#1F4E6E] hover:bg-[#1F4E6E] hover:text-white font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all transform hover:-translate-y-1">
                                Iniciar primer registro
                            </a>
                            @endif
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($recentLogs as $log)
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-stone-50 hover:bg-stone-100 rounded-2xl transition border border-transparent hover:border-stone-200 gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white text-[#C56A3D] rounded-xl flex items-center justify-center border border-[#E6DBCB] shadow-sm flex-shrink-0">
                                            <i class="fas fa-landmark text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-stone-800 text-lg leading-tight">{{ $log->name }}</h4>
                                            <p class="text-xs text-stone-500 mt-1 flex items-center gap-2">
                                                <i class="fas fa-map-marker-alt text-[#C56A3D]"></i> {{ $log->province }}
                                                <span class="text-stone-300">|</span>
                                                <i class="far fa-clock"></i> {{ $log->created_at->diffForHumans() }}
                                                @if($isAdmin)
                                                    <span class="text-stone-300">|</span>
                                                    <i class="fas fa-user text-[#1F4E6E]"></i> {{ $log->user->name }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 sm:w-auto w-full justify-between sm:justify-end">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $log->status === 'approved' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-yellow-100 text-yellow-700 border border-yellow-200' }}">
                                            {{ $log->status === 'approved' ? 'Verificado' : 'En Revisión' }}
                                        </span>
                                        <a href="{{ route('logs.show', $log->id) }}" class="text-[#1F4E6E] hover:text-[#C56A3D] font-bold text-sm bg-white border border-stone-200 hover:border-[#C56A3D] px-4 py-2 rounded-xl shadow-sm transition flex items-center">
                                            Ver <i class="fas fa-chevron-right text-[10px] ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 text-center">
                            <a href="{{ route('logs.index') }}" class="text-sm font-bold text-[#C56A3D] hover:underline">Ver todo el explorador de bitácoras <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
