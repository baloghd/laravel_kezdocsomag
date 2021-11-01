@include("layout.header")
@include("layouts.navigation")


<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">

    <div class="flex-none">
        <img src="{{ $movie->image }}" alt="poster" class="w-64 lg:w-96">
    </div>

    <div class="md:ml-24">

        <h2 class="text-4xl mt-4 font-bold">{{ $movie->title }} ({{ $movie->year }})</h2>
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


          
<ul>
@foreach ($ratings as $rating)
    <li><span class="text-xl font-bold">user{{$rating->user_id}}</span> <span class="text-l font-bold">(értékelés={{$rating->rating}})</span>: {{$rating->comment}}</li>
@endforeach
</ul>
<div class="justify-items-center">
{!! $ratings->links() !!}
</div>

</div>