<section>
    <header>
        <h2 class="text-xl font-serif font-bold text-[#1F4E6E]">
            Información del Perfil
        </h2>

        <p class="mt-1 text-sm text-stone-500">
            Actualiza la información básica de tu cuenta y tu dirección de correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nombre Completo" class="text-stone-700 font-semibold text-sm" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full py-2 px-3 border-stone-300 focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/30 rounded-xl shadow-sm transition text-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-xs" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Correo Electrónico" class="text-stone-700 font-semibold text-sm" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full py-2 px-3 border-stone-300 focus:border-[#C56A3D] focus:ring focus:ring-[#C56A3D]/30 rounded-xl shadow-sm transition text-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-xs" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                    <p class="text-sm text-yellow-800">
                        Tu dirección de correo electrónico no está verificada.

                        <button form="send-verification" class="underline text-sm font-bold text-[#C56A3D] hover:text-[#8B5A2B] rounded-md focus:outline-none transition">
                            Haz clic aquí para reenviar el correo de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Se ha enviado un nuevo enlace a tu correo electrónico.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-stone-100">
            <div>
                <x-input-label value="N° de Matrícula" class="text-stone-500 font-semibold text-xs uppercase tracking-wide" />
                <p class="mt-1 text-sm font-mono font-bold text-stone-700 bg-stone-50 py-2 px-3 rounded-lg border border-stone-200">{{ $user->license_number ?? 'No asignada' }}</p>
            </div>
            <div>
                <x-input-label value="Institución" class="text-stone-500 font-semibold text-xs uppercase tracking-wide" />
                <p class="mt-1 text-sm font-bold text-stone-700 bg-stone-50 py-2 px-3 rounded-lg border border-stone-200 truncate">{{ $user->institution ?? 'No asignada' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-[#1F4E6E] hover:bg-[#153850] text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex items-center gap-2 text-sm">
                <i class="fas fa-save"></i> Guardar Cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-bold text-green-600 flex items-center gap-1"
                ><i class="fas fa-check"></i> Actualizado correctamente.</p>
            @endif
        </div>
    </form>
</section>
