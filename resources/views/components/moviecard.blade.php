<div class="card mx-auto flex flex-col md:flex_row">
    
    <h2 class="card-header"><a class="underline text-3xl text-bold" href="/movies/{{$id}}">{{ $title }}</a> <span>{{ $avg_rating }}</span></h3>
    <div class="poster">
        <img class="" src="{{$img}}">
    </div>
    <div class="flex flex-wrap items-center text-gray-400 text-sm break-all">
            <span class="ml-1 font-bold">rendező: </span>{{ $director }}
            <span class="ml-1 font-bold">hossz: </span> {{ $length }} perc</span>
        </div>
   
    <div class="card-body">
       <p class="card-text">{{ $slot }}</p>
    </div>
</div>


