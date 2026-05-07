<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="font-serif font-bold text-2xl text-[#8B5A2B] leading-tight">
                <i class="fas fa-user-circle text-[#C56A3D] mr-2"></i> Mi Perfil Profesional
            </h2>
            @if(auth()->user()->is_verified)
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-700">
                    <i class="fas fa-check-circle mr-1"></i> Verificado
                </span>
            @else
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-yellow-100 text-yellow-700">
                    <i class="fas fa-clock mr-1"></i> Pendiente
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-12 bg-[#FDF9F2] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-3xl border border-[#E6DBCB] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#F7EFE2] rounded-bl-full -z-10 opacity-50"></div>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-3xl border border-[#E6DBCB]">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-red-50/50 shadow-sm sm:rounded-3xl border border-red-100">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
