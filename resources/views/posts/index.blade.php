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
                                        <h2 class="card-title font-bold text-xl mb-2">{{ $post->user->name }}</h2>
                                        <p class="card-text text-muted">{{ $post->created_at->diffForHumans() }}</p>
                                        <p class="card-text">{{ $post->content }}</p>
                                        <button href="" class="btn btn-primary mt-2">Leer más</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
