<x-app-layout>
    @push('styles')
        <!-- jQuery -->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $movie['title'] }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">        
              <div class="d-flex">
                <img src="https://image.tmdb.org/t/p/w1280/{{ $movie['backdrop_path'] }}" alt="banner-pelicula" class="d-block w-100">
              </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
</x-app-layout>
