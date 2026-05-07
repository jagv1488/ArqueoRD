<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-[#8B5A2B] leading-tight">
            <i class="fas fa-book-open text-[#C56A3D] mr-2"></i> Nueva Bitácora de Campo
        </h2>
    </x-slot>

    <div class="py-12 bg-[#FDF9F2] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:archaeologist.log-wizard />
        </div>
    </div>
</x-app-layout>
