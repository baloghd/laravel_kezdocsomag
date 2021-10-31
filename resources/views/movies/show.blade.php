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

        <!--
            @foreach ($ratings as $rating)
        <div class="md:ml-24">
            <h3 class="text-l mt-4 font-bold">
                <span>user_id={{ $rating->user_id }}</span>
                <span>{{ $rating->created_at }}</span>
            </h3>
            <h4>rating={{ $rating->rating }}</h4>
            <div class="">{{ $rating->comment}}</div>
            </div>
        @endforeach
            -->

          
<ul>
@foreach ($ratings as $rating)
    <li>{{$rating->comment}}</li>
@endforeach
</ul>

{!! $ratings->links() !!}


</div>