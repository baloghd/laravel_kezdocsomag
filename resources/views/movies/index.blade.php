@include("layout.header")
@include("layouts.navigation")

@if (Auth::check() && (Auth::user()->is_admin))
<div>
    <h1 class="text-3xl"><a href="/movies/create">Új film</a></h1>
</div>
@endif


@foreach ($ratings as $rating)

    @component('components.moviecard')

    @slot('id')
        {{$rating->movie->id}}
    @endslot

    @slot('img')
        {{$rating->movie->image}}
    @endslot

    @slot('title')
        {{$rating->movie->title}}
    @endslot

    @slot('is_deleted')
        {{$rating->movie->deleted_at}}
    @endslot

    @slot('avg_rating')
        Átlagos értékelés: {{$rating->avg_rating}}
    @endslot

    @slot('director')
        {{$rating->movie->director}}
    @endslot

    @slot('length')
        {{$rating->movie->length}}
    @endslot

    {{$rating->movie->description}}

    @endcomponent

@endforeach

{!! $ratings->links() !!}
