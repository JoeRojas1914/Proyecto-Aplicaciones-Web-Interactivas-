<x-app-layout>
    @push('styles')
        <!-- jQuery -->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <style>
            .rating-percentage{
                display: flex;
                justify-content: center;
                align-items: center;
                width: 70px;
                height: 70px;
                border-width: 5px;
            }
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reseñas de película') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">        
                <div class="d-flex text-gray-900">
                    <img src="https://image.tmdb.org/t/p/w1280/{{ $movie['backdrop_path'] }}" alt="banner-pelicula" class="d-block w-100">
                </div>
                <div class="d-flex flex-column text-gray-900 p-2">
                    <div class="d-flex justify-content-between">

                        <div class="flex-column">
                            <h1 class="mt-2">{{ $movie['title'] }}</h1>
                            <div class="d-flex justify-content-start">
                                @foreach ($movie['genres'] as $genre)
                                    <span class="badge me-2" style="background-color: #17a2b8;">{{ $genre['name'] }}</span>  
                                @endforeach
                            </div>
                        </div>

                        <div>
                        @if ($movie['vote_average'] < 5)
                            <div class="rating-percentage rounded-circle border-danger" style="border-color: ">
                                {{ $movie['vote_average'] * 10 }}%
                            </div>
                        @endif
                        @if ($movie['vote_average'] >= 5 && $movie['vote_average'] < 7.5)
                            <div class="rating-percentage rounded-circle border-warning" style="border-color: ">
                                {{ $movie['vote_average'] * 10 }}%
                            </div>
                        @endif
                        @if ($movie['vote_average'] >= 7.5)
                            <div class="rating-percentage rounded-circle border-success">
                                {{ $movie['vote_average'] * 10 }}%
                            </div>
                        @endif
                        </div>
                    </div>

                    

                    <p class="mt-2">{{ $movie['runtime'] }} min</p>
                    <p class="mb-0 text-secondary fw-bold">Sinopsis</p>
                    <p class="mt-0">{{ $movie['overview'] }}</p>
                </div>

                {{-- TODO Jalar de base de datos todas las reseñas con el ID de esta película --}}
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
</x-app-layout>
