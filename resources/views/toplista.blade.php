@include("layout.header")
@include("layouts.navigation")

@foreach ($ratings as $rating)

    @component('components.moviecard')

    @slot('id')
        {{$rating->movie->id}}
    @endslot

    @slot('img')
        {{$rating->movie->image}}
    @endslot

    @slot('is_deleted')
        {{$rating->movie->deleted_at}}
    @endslot

    @slot('title')
        {{$rating->movie->title}}
    @endslot

    @slot('avg_rating')
        Átlagos értékelés: {{number_format($rating->avg_rating, 1)}}
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
