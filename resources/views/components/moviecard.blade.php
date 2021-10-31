<div class="card">
    <h3 class="card-header"><a href="/movies/{{$id}}">{{ $title }}</a> <span>{{ $avg_rating }}</span></h3>
    <div class="flex flex-wrap items-center text-gray-400 text-sm break-all">
            <span class="ml-1 font-bold">rendező: </span>{{ $director }}
            <span class="ml-1 font-bold">hossz: </span> {{ $length }} perc</span>
        </div>
    <div class="card-body">
       <p class="card-text">{{ $slot }}</p>
    </div>
</div>