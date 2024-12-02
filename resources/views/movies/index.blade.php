<x-app-layout>
    @push('styles')
        <style>
            @media (min-width: 768px) {
                .carousel-inner.inner-inline{
                    display: flex;
                }
                .carousel-inner.inner-inline .carousel-item {
                    margin-right: 0;
                    flex: 0 0 33.333333%;
                    display: block;
                }
            }
        </style>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Películas') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">        
                <div id="carouselTopRated" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        {{-- TODO PONER IMAGEN CON FOREACH/ --}}
                        @foreach ($topRatedMovies['results'] as $index => $topRatedMovie)    
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="position: relative" data-bs-interval="3000">
                                <img src="https://image.tmdb.org/t/p/w1280/{{ $topRatedMovie['backdrop_path'] }}" alt="poster" class="d-block w-100" style="z-index: 1;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 70%;"></div>
                                <div class="carousel-caption d-md-block text-start">
                                    <h5>{{ $topRatedMovie['title'] }}</h5>
                                    <p style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                        {{ $topRatedMovie['overview'] }}
                                    </p>
                                    <a href="{{ route('movies.show', ['id_movie' => $topRatedMovie['id']]) }}" class="btn btn-secondary">Reseñas</a>
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

                <div id="carouselNowPlaying" class="carousel mb-4 ps-4">
                    <h4>En cines</h4>
                    <div class="carousel-inner inner-inline">
                        @foreach ($nowPlayingMovies['results'] as $index => $nowPlayingMovie)
                            <div class="carousel-item item-inline {{ $index == 0 ? 'active' : '' }}">
                                <div class="card me-3 my-2" style="min-width: 15rem">
                                    <img src="https://image.tmdb.org/t/p/w1280/{{ $nowPlayingMovie['backdrop_path'] }}" class="card-img-top" alt="bg-missing" />
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title">{{$nowPlayingMovie['title']}}</h5>
                                            <p class="card-text">{{$nowPlayingMovie['vote_average']}}</p>
                                        </div>
                                        <a href="{{ route('movies.show', ['id_movie' => $nowPlayingMovie['id']]) }}" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselNowPlaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselNowPlaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                <div id="carouselUpcoming" class="carousel mb-4 ps-4">
                    <h4>Próximamente</h4>
                    <div class="carousel-inner  inner-inline">
                        @foreach ($upcomingMovies['results'] as $index => $upcoming)
                            <div class="carousel-item item-inline {{ $index == 0 ? 'active' : '' }}">
                                <div class="card me-3 my-2" style="min-width: 15rem">
                                    <img src="https://image.tmdb.org/t/p/w1280/{{ $upcoming['backdrop_path'] }}" class="card-img-top" alt="bg-missing" />
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title">{{$upcoming['title']}}</h5>
                                            <p class="card-text">{{$upcoming['vote_average']}}</p>
                                        </div>
                                        <a href="{{ route('movies.show', ['id_movie' => $upcoming['id']]) }}" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselUpcoming" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselUpcoming" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var carouselWidth = $("#carouselUpcoming .inner-inline")[0].scrollWidth;
            var cardWidth = $("#carouselUpcoming .item-inline").width();
            var scrollPosition = 0;
            $("#carouselUpcoming .carousel-control-next").on("click", function () {
                if (scrollPosition < (carouselWidth - cardWidth * 4)) { //check if you can go any further
                    scrollPosition += cardWidth;  //update scroll position
                    $("#carouselUpcoming .inner-inline").animate({ scrollLeft: scrollPosition }, 600); //scroll left
                }
            });
            $("#carouselUpcoming .carousel-control-prev").on("click", function () {
                if (scrollPosition > 0) {
                    scrollPosition -= cardWidth;
                    $("#carouselUpcoming .inner-inline").animate({ scrollLeft: scrollPosition }, 600);
                }
            });

            var carouselWidth2 = $("#carouselNowPlaying .inner-inline")[0].scrollWidth;
            var cardWidth2 = $("#carouselNowPlaying .item-inline").width();
            var scrollPosition2 = 0;
            $("#carouselNowPlaying .carousel-control-next").on("click", function () {
                if (scrollPosition2 < (carouselWidth2 - cardWidth2 * 4)) { //check if you can go any further
                    scrollPosition2 += cardWidth2;  //update scroll position
                    $("#carouselNowPlaying .inner-inline").animate({ scrollLeft: scrollPosition2 }, 600); //scroll left
                }
            });
            $("#carouselNowPlaying .carousel-control-prev").on("click", function () {
                if (scrollPosition2 > 0) {
                    scrollPosition2 -= cardWidth2;
                    $("#carouselNowPlaying .inner-inline").animate({ scrollLeft: scrollPosition2 }, 600);
                }
            });

            var multipleCardCarousel = document.querySelector( "#carouselUpcoming");
            if (window.matchMedia("(min-width: 768px)").matches) {
                //rest of the code
                var carousel = new bootstrap.Carousel(multipleCardCarousel, {
                    interval: false,
                    wrap: false,
            });
            } else {
                $(multipleCardCarousel).addClass("slide");
            }

            var multipleCardCarousel2 = document.querySelector( "#carouselNowPlaying");
            if (window.matchMedia("(min-width: 768px)").matches) {
                //rest of the code
                var carousel = new bootstrap.Carousel(multipleCardCarousel2, {
                    interval: false,
                    wrap: false,
            });
            } else {
                $(multipleCardCarousel2).addClass("slide");
            }
        </script>
    @endpush
</x-app-layout>
