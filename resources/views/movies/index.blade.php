@include("layout.header")
@include("layouts.navigation")

<ul>
@foreach ($movies as $movie)

    @component('components.moviecard')    

    @slot('id')
        {{$movie->id}}
    @endslot

    @slot('title')
        {{$movie->title}}
    @endslot

    @slot('director')
        {{$movie->director}}
    @endslot

    @slot('length')
        {{$movie->length}}
    @endslot

    @slot("avg_rating")
    @endslot


    {{$movie->description}}

    @endcomponent

@endforeach
</ul>

{!! $movies->links() !!}
