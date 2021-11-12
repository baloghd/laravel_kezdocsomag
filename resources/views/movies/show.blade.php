@include("layout.header")
@include("layouts.navigation")

@if (Auth::check() && (Auth::user()->is_admin))
<div>
    <h1 class="text-3xl"><a href={{ route('movies.edit', ['movie' => $movie->id]) }}>Film módosítása</table></a></h1>
    @if(Session::has('modify'))
        {{Session::get('modify')}}
    @endif
</div>
<div>
    <h1 class="text-3xl"><a href={{ route('movies.deleteratings', ['id' => $movie->id]) }}>Értékelések törlése</a></h1>
    @if(Session::has('delete_ratings'))
        {{Session::get('delete_ratings')}}
    @endif
</div>

@if (!is_null($movie->deleted_at))
<div>
    <h1 class="text-3xl"><a href={{ route('movies.restore', ['id' => $movie->id]) }}>Film visszaállítása</a></h1>
    @if(Session::has('delete_movie'))
        {{Session::get('delete_movie')}}
    @endif
</div>
@else
<div>
    <h1 class="text-3xl"><a href={{ route('movies.delete', ['id' => $movie->id]) }}>Film törlése</a></h1>
    @if(Session::has('restore_movie'))
        {{Session::get('restore_movie')}}
    @endif
</div>

@endif

@endif

<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">

    @if (!str_contains($movie->image, "placeholder.com"))
    <div class="flex-none">
        <img src="{{ route('movies.poster', ['id' => $movie->id]) }}" alt="poster" class="w-64 lg:w-96">
    </div>
    @else
    <div class="flex-none">
        <img src="{{ $movie->image }}" alt="poster" class="w-64 lg:w-96">
    </div>
    @endif




    <div class="md:ml-24">

        <h2 class="text-4xl mt-4 font-bold">{{ $movie->title }} ({{ $movie->year }})</h2>
        @if (Auth::check() && (Auth::user()->is_admin))
                @if (!is_null($movie->deleted_at))
                    <h2 class="text-3xl text-red-600">{{' törölve ekkor: ' . $movie->deleted_at }}</h2>
                @endif

            @endif
        <div class="flex flex-wrap items-center text-gray-400 text-sm break-all">
            <span class="ml-1 font-bold">rendező: </span>{{ $movie->director }}
            <span class="ml-1 font-bold">hossz: </span> {{ $movie->length }} perc</span>
        </div>

        <p class="text-gray-800 mt-8">
        {{ $movie->description }}
        </p>
    </div>

</div>

<div class="container mx-auto flex flex-col justify-items-center">
@auth

    @if ($movie->ratings_enabled)



        @component('components.create_rating', ["existing_rating" =>  $ex_rating, 'movie_id' => $movie->id, "message" => $message])

            @slot("existing_comment")

                    {{$ex_comment}}

            @endslot
        @endcomponent

    @else
        <h2 class="text-3xl">ezt a filmet nem lehet értékelni.</h2>
    @endif


@endauth

</div>


<div class="container mx-auto flex flex-col justify-items-center">


@isset($_GET['t'])
    <span class="text-3xl text-green-500">{{"az értékelések törlése sikeres!"}}</span>
@endisset

<ul>
@foreach ($ratings as $rating)
    <li><span class="text-xl font-bold">userid={{$rating->user_id}}</span> <span class="text-l font-bold">(értékelés={{$rating->rating}})</span>: {{$rating->comment}}</li>
@endforeach
</ul>

<div class="justify-items-center">
{!! $ratings->links() !!}
</div>

</div>
