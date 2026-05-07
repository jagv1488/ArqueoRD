<x-guest-layout>
    <div class="text-center mb-6">
        <i class="fas fa-shield-alt text-4xl text-[#1F4E6E] mb-3"></i>
        <h2 class="text-2xl font-serif font-bold text-[#8B5A2B]">Área Segura</h2>
    </div>

    <div class="mb-6 text-sm text-stone-600 text-center">
        Esta es un área protegida de ArqueoRD. Por favor, confirma tu contraseña antes de continuar para validar tu identidad.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" value="Tu Contraseña" class="text-stone-700 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-stone-300 focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/30 rounded-xl shadow-sm transition" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="w-full bg-[#C56A3D] hover:bg-[#A65D3A] text-white font-semibold py-3 px-4 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex justify-center items-center gap-2">
                Confirmar Identidad <i class="fas fa-lock"></i>
            </button>
        </div>
    </form>
</x-guest-layout>
