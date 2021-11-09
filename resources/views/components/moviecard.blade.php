
<div class="flex space-x-4 mt-4 mb-4 ">

    <div class="block flex space-x-4 mt-4 mb-4">


        <div class="mx-4 l-64">
            <img class="float-left mx-4 mr-5" src="{{$img}}">
            <h2><a class="underline text-3xl text-bold" href="/movies/{{$id}}">{{ $title }}</a> <span>{{ $avg_rating }}</span></h2>
            @if (Auth::check() && (Auth::user()->is_admin))
                <h2 class="text-3xl text-red-600">{{$is_deleted}}</h2>
            @endif
            <div class="flex flex-wrap items-center text-gray-400 text-sm break-all">
                    <span class="ml-1 font-bold">rendező: </span>{{ $director }}
                    <span class="ml-1 font-bold">hossz: </span> {{ $length }} perc</span>
            </div>
            <p class="text-gray-800 mt-8 text-justify w-1/2">{{ $slot }}</p>

        </div>


    </div>

</div>
