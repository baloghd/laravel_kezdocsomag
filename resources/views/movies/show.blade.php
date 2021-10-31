@include("layout.header")



<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
    <div class="flex-none">
    <img src="{{ $movie->image }}" alt="poster" class="w-64 lg:w-96">
    </div>
    <div class="md:ml-24">
    <h2 class="text-4xl mt-4 font-bold">{{ $movie->title }} ({{ $movie->year}})</h2>
    <div class="flex flex-wrap items-center text-gray-400 text-sm break-normal">
        <span class="ml-1">rendező: {{ $movie->director }}</span> 
        <span class="ml-1">hossz: {{ $movie->length }} perc</span>
    </div>

    <p class="text-gray-800 mt-8">
    {{ $movie->description }}
    </p>

</div>
</div>
  