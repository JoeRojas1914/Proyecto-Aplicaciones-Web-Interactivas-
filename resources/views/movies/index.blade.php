<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Películas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">        
                {{-- <div class="p-6 text-gray-900">
                    {{ __("Bienvenido a CineTotal 🎥🍿 Descubre el mundo del cine como nunca antes. En CineTotal puedes:") }}
                    <ul class="list-disc pl-6 mt-4">
                        <li>🌟 <strong>Compartir tus opiniones:</strong> Escribe reviews de tus películas favoritas y sé parte de nuestra comunidad cinéfila.</li>
                        <li>👀 <strong>Explorar reviews:</strong> Lee lo que otros usuarios opinan y encuentra recomendaciones increíbles.</li>
                        <li>📋 <strong>Crear tu watchlist:</strong> Agrega películas que quieres ver y mantén tu lista siempre actualizada.</li>
                    </ul>
                    <p class="mt-4">Únete ahora y conviértete en un crítico de cine ⭐ ¡Tu próxima gran película te espera!</p>
                </div> --}}

                <div id="carouselTopRated" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner ">
                        {{-- TODO PONER IMAGEN CON FOREACH/ --}}
                        @foreach ($topRatedMovies['results'] as $index => $topRatedMovie)    
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="position: relative" data-bs-interval="3000">
                                <img src="https://image.tmdb.org/t/p/w1280/{{ $topRatedMovie['backdrop_path'] }}" alt="poster" class="d-block w-100" style="z-index: 1;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                                <div class="position-absolute start-0 w-80 h-100 ms-4 mt-lg-4" style="top: 50%;">
                                    <div class="text-start mt-md-4" style="border: 1px solid red;">
                                        <div class="d-md-block m-0">
                                            <h4 class="text-light" style="font-size: 1.25rem;">{{ $topRatedMovie['original_title'] }}</h4>
                                            <p class="text-light m-0" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; font-size: 0.875rem;">
                                                {{ $topRatedMovie['overview'] }}
                                            </p>
                                            {{-- <a href="{{ route('movies.show', $topRatedMovie['id']) }}" class="btn btn-primary">Ver más</a> --}}
                                            <button class="btn btn-secondary m-0">Reseñas</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselTopRated" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselTopRated" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
