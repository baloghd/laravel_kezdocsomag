@include("layout.header")
@include("layouts.navigation")

@if (Auth::check() && (Auth::user()->is_admin))
<div>
    <h1 class="text-3xl"><a href="/movies/create">Új film</a></h1>
</div>
@endif


@foreach ($movies as $movie)

    @component('components.moviecard')

    @slot('id')
        {{$movie->id}}
    @endslot

    @if (!str_contains($movie->image, "placeholder.com"))
        @slot('img')
            {{ route('movies.poster', ['id' => $movie->id]) }}
        @endslot
    @else
        @slot('img')
            {{ $movie->image }}
        @endslot
    @endif



    @slot('title')
        {{$movie->title}}
    @endslot


    @slot('is_deleted')
        @if (!is_null($movie->deleted_at))
            {{"törölve ekkor:" . $movie->deleted_at}}
        @else
            {{""}}
        @endif
    @endslot


    @slot('avg_rating')
        Átlagos értékelés: {{number_format($rating_averages[$movie->id], 1)}}
    @endslot

    @slot('director')
        {{$movie->director}}
    @endslot

    @slot('length')
        {{$movie->length}}
    @endslot

    {{$movie->description}}

    @endcomponent

@endforeach

{!! $movies->links() !!}
