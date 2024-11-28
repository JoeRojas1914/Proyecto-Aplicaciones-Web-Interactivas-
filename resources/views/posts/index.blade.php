<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reseñas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title text-2xl font-bold mb-4">Últimas reseñas</h1>
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class=" mb-4">
                                <div class="card h-100 shadow-lg">
                                    <img class="card-img-top" src="{{ $post->image }}" alt="{{ $post->title }}">
                                    <div class="card-body">
                                        <h2 class="card-title font-bold text-xl mb-1">{{ $post->movie_title}}</h2>
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
                    </div>

                     <!-- Enlaces de paginación -->
                     <div class="d-flex justify-content-center mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
