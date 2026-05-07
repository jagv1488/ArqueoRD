<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-16 h-16 bg-[#F7EFE2] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#C56A3D]/20">
            <i class="fas fa-envelope-open-text text-3xl text-[#C56A3D]"></i>
        </div>
        <h2 class="text-2xl font-serif font-bold text-[#8B5A2B]">Verifica tu correo</h2>
    </div>

    <div class="mb-6 text-sm text-stone-600 text-center leading-relaxed bg-stone-50 p-4 rounded-xl border border-stone-100">
        ¡Gracias por registrarte! Antes de comenzar, debes verificar tu correo electrónico haciendo clic en el enlace que te acabamos de enviar. Si no lo recibiste, con gusto te enviaremos otro.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-[#C56A3D] bg-[#C56A3D]/10 p-3 rounded-lg text-center border border-[#C56A3D]/20">
            Un nuevo enlace de verificación ha sido enviado a la dirección de correo electrónico que proporcionaste.
        </div>
    @endif

    <div class="mt-4 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-[#1F4E6E] hover:bg-[#153850] text-white font-semibold py-3 px-4 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex justify-center items-center gap-2">
                <i class="fas fa-sync-alt"></i> Reenviar correo de verificación
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-sm text-stone-500 hover:text-red-600 font-medium transition py-2">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
