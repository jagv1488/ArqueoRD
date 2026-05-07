<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-[#8B5A2B] leading-tight">
            Explorador de Bitácoras Digitales
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:logs.log-index />
        </div>
    </div>
</x-app-layout>
