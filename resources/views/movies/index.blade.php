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

    @slot('title')
        {{$rating->movie->title}}
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