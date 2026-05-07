<x-guest-layout>
    <div class="text-center mb-6">
        <i class="fas fa-key text-4xl text-[#C56A3D] mb-3"></i>
        <h2 class="text-2xl font-serif font-bold text-[#8B5A2B]">Recuperar Acceso</h2>
    </div>

    <div class="mb-6 text-sm text-stone-600 text-center leading-relaxed">
        ¿Olvidaste tu contraseña? No hay problema. Indícanos tu dirección de correo electrónico y te enviaremos un enlace para que elijas una nueva.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Correo Electrónico Registrado" class="text-stone-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-stone-300 focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/30 rounded-xl shadow-sm transition" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 flex flex-col gap-3">
            <button type="submit" class="w-full bg-[#C56A3D] hover:bg-[#A65D3A] text-white font-semibold py-3 px-4 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex justify-center items-center gap-2">
                <i class="fas fa-paper-plane"></i> Enviar Enlace de Reseteo
            </button>
            <a href="{{ route('login') }}" class="text-center text-sm text-stone-500 hover:text-[#1F4E6E] transition underline">Volver al inicio de sesión</a>
        </div>
    </form>
</x-guest-layout>
