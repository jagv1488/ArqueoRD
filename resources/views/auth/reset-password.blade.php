<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-serif font-bold text-[#8B5A2B]">Nueva Contraseña</h2>
        <p class="text-sm text-stone-500 mt-1">Asegúrate de crear una contraseña fuerte.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-stone-700 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full bg-stone-50 border-stone-300 rounded-xl shadow-sm text-stone-500" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Nueva Contraseña" class="text-stone-700 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-stone-300 focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/30 rounded-xl shadow-sm transition" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Nueva Contraseña" class="text-stone-700 font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-stone-300 focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/30 rounded-xl shadow-sm transition" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-[#1F4E6E] hover:bg-[#153850] text-white font-semibold py-3 px-4 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex justify-center items-center gap-2">
                Guardar y Acceder <i class="fas fa-check"></i>
            </button>
        </div>
    </form>
</x-guest-layout>
