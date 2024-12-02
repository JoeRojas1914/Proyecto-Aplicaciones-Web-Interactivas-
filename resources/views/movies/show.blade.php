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
            <div class="bg-white overflow-hidden shadow-sm pb-5">        
                <div class="d-flex text-gray-900">
                    <img src="https://image.tmdb.org/t/p/w1280/{{ $movie['backdrop_path'] }}" alt="banner-pelicula" class="d-block w-100">
                </div>
                <div class="d-flex flex-column text-gray-900 p-4">
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
                <h3 class="mx-4">Reseñas</h3>
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                    <div class=" mb-4 mx-4">
                        <div class="card h-100 shadow-lg">
                            {{-- <img class="card-img-top" src="{{ $post->image }}" alt="{{ $post->title }}"> --}}
                            <div class="card-body">
                                <h2 class="card-title font-bold text-xl mb-1">{{ $post->title}}</h2>
                                <div class="d-flex align-items-center mb-4">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $post->rating)
                                            <svg class="bi bi-star-fill text-warning" width="1em" height="1em" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.396.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        @else
                                            <svg class="bi bi-star text-muted" width="1em" height="1em" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                                <path d="M2.866 14.85c-.078.443.36.79.746.592L8 13.187l4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.329-.32.158-.888-.283-.95l-4.898-.696L8.462.792a.513.513 0 00-.927 0L5.351 5.12l-4.898.696c-.441.062-.612.63-.283.95l3.522 3.356-.83 4.73z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <p class="card-text text-muted mb-0">{{ $post->user->name }} </p>
                                <p class="card-text text-muted mt-0">{{ $post->created_at->diffForHumans() }}</p>
                                <p class="card-text">{{ $post->content }}</p>
                                <button href="" class="btn btn-primary mt-2">Leer más</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="alert alert-info mx-4 mb-5">No hay reseñas para esta película</div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
</x-app-layout>
