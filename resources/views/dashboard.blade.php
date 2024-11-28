<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CineTotal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Bienvenido a CineTotal 🎥🍿 Descubre el mundo del cine como nunca antes. En CineTotal puedes:") }}
                    <ul class="list-disc pl-6 mt-4">
                        <li>🌟 <strong>Compartir tus opiniones:</strong> Escribe reviews de tus películas favoritas y sé parte de nuestra comunidad cinéfila.</li>
                        <li>👀 <strong>Explorar reviews:</strong> Lee lo que otros usuarios opinan y encuentra recomendaciones increíbles.</li>
                        <li>📋 <strong>Crear tu watchlist:</strong> Agrega películas que quieres ver y mantén tu lista siempre actualizada.</li>
                    </ul>
                    <p class="mt-4">Únete ahora y conviértete en un crítico de cine ⭐ ¡Tu próxima gran película te espera!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
