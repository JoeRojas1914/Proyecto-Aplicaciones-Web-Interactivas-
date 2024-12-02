<x-app-layout>
    @push('styles')
        <!-- jQuery -->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
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
                    <p class="mt-0 mb-4">{{ $movie['overview'] }}</p>
                    <form action="{{ route('watchlist.toggle', $movie['id']) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn {{ $isInWatchList ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            <i class="fas fa-bookmark"></i> {{ $isInWatchList ? 'Quitar de mi lista' : 'Ver más tarde' }}
                        </button>
                    </form>
                </div>

                {{-- TODO Jalar de base de datos todas las reseñas con el ID de esta película --}}
                <div class="d-flex justify-content-between mx-4 mb-4">
                    <h3>Reseñas</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPostModal">Crear reseña <i class="fa-solid fa-plus"></i></button>
                </div>
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                    <div class=" mb-4 mx-4">
                        <div class="card h-100 shadow-lg" data-post-id="{{ $post->id }}">
                            <div class="card-body">
                                <h2 class="card-title font-bold text-xl mb-1">{{ $post->movie_title }}</h2>
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
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button class="btn btn-outline-success like-btn me-2">
                                    <i class="fas fa-thumbs-up"></i>
                                </button>
                                <button class="btn btn-outline-danger dislike-btn">
                                    <i class="fas fa-thumbs-down"></i>
                                </button>
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


    <div class="modal fade" tabindex="-1" id="newPostModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear reseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column">
                    <h1 class="mt-2">{{ $movie['title'] }}</h1>
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $movie['id'] }}" name="movie_id">
                        <input type="hidden" value="{{ $movie['title'] }}" name="title">
                        <div class="mb-3">
                            <label for="ratingInput" class="form-label">Calificación</label>
                            <select name="rating" id="ratingInput" class="form-select">
                                @for ($i = 0; $i <= 5; $i++)
                                    <option value="{{ $i }}">
                                        @for ($j = 0; $j < $i; $j++)
                                            &#9733;
                                        @endfor
                                        @for ($j = $i; $j < 5; $j++)
                                            &#9734;
                                        @endfor
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="contentInput" class="form-label">Reseña</label>
                            <br>
                            <textarea name="content" id="contentInput" rows="20" style="width:100%" placeholder="Escribe tu reseña."></textarea>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> --}}
                            <button type="submit" class="btn btn-primary">Subir reseña</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const likeButtons = document.querySelectorAll('.like-btn');
            const dislikeButtons = document.querySelectorAll('.dislike-btn');
        
            likeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const postId = button.closest('.card').dataset.postId;
        
                    fetch('/like', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ post_id: postId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'liked') {
                            button.classList.add('active');
                            button.parentElement.querySelector('.dislike-btn').classList.remove('active');
                        } else if (data.status === 'removed') {
                            button.classList.remove('active');
                        }
                    });
                });
            });
        
            dislikeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const postId = button.closest('.card').dataset.postId;
        
                    fetch('/dislike', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ post_id: postId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'disliked') {
                            button.classList.add('active');
                            button.parentElement.querySelector('.like-btn').classList.remove('active');
                        } else if (data.status === 'removed') {
                            button.classList.remove('active');
                        }
                    });
                });
            });
        });
        
    </script>
    @endpush
</x-app-layout>
