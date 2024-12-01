<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Películas') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">        
                <div id="carouselTopRated" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner ">
                        {{-- TODO PONER IMAGEN CON FOREACH/ --}}
                        @foreach ($topRatedMovies['results'] as $index => $topRatedMovie)    
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="position: relative" data-bs-interval="3000">
                                <img src="https://image.tmdb.org/t/p/w1280/{{ $topRatedMovie['backdrop_path'] }}" alt="poster" class="d-block w-100" style="z-index: 1;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 70%;"></div>
                                <div class="carousel-caption d-md-block text-start">
                                    <h5>{{ $topRatedMovie['original_title'] }}</h5>
                                    <p style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                        {{ $topRatedMovie['overview'] }}
                                    </p>
                                    <button class="btn btn-secondary">Reseñas</button>
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
