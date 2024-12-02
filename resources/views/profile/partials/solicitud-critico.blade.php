<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Solicitud para Perfil Verificado') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("¿Deseas contar con un perfil verificado? Sube tu archivo que lo comprueba, lo verificaremos y lo aprobaremos.") }}
        </p>
    </header>

    <form method="post" action="{{ route('solicitud.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="archivo" :value="__('Archivo de verificación')" />
            <input 
                id="archivo" 
                name="archivo" 
                type="file" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                required 
            />
            <x-input-error class="mt-2" :messages="$errors->get('archivo')" />
        </div>
    
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
    
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Archivo subido correctamente.') }}</p>
            @endif
        </div>
    </form>
    
</section>
