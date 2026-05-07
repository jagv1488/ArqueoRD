<section class="space-y-6">
    <header>
        <h2 class="text-xl font-serif font-bold text-red-800">
            <i class="fas fa-exclamation-triangle mr-2"></i> Zona de Peligro: Eliminar Cuenta
        </h2>

        <p class="mt-1 text-sm text-red-600/80 font-medium">
            Una vez que elimines tu cuenta, todos tus recursos y datos personales se borrarán permanentemente. Ten en cuenta que las bitácoras y hallazgos registrados quedarán resguardados a nombre del Ministerio de Cultura por motivos legales.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex items-center gap-2 text-sm"
    ><i class="fas fa-trash-alt"></i> Eliminar mi cuenta permanentemente</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-serif font-bold text-stone-900 mb-2">
                ¿Estás completamente seguro?
            </h2>

            <p class="text-sm text-stone-600 mb-6 leading-relaxed">
                Esta acción es irreversible. Por favor, ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente del sistema ArqueoRD.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Contraseña" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full py-3 px-4 border-stone-300 focus:border-red-500 focus:ring focus:ring-red-500/30 rounded-xl shadow-sm transition text-sm"
                    placeholder="Ingresa tu contraseña actual"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-500" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 rounded-xl text-stone-600 bg-white border border-stone-300 hover:bg-stone-100 font-medium transition shadow-sm text-sm">
                    Cancelar
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg text-sm">
                    Sí, eliminar cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>
