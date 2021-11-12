@include("layout.header")
@include("layouts.navigation")
<h1 class="text-4xl mb-4 mx-4">Film módosítása </h1>
<form action="{{ route('movies.update', $movie->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="rendered-form">
        <div class="mb-4 mx-4">
            <label for="title" class="">Cím</label>
            <input type="text" class="form-control" name="title" access="false" id="title" value="{{$movie->title}}">
        </div>
        <div class="mb-4 mx-4">
            <label for="director" class="">Rendező</label>
            <input type="text" class="form-control" name="director" access="false" id="director" value="{{$movie->director}}">
        </div>
        <div class="mb-4 mx-4">
            <label for="year" class="">Év </label>
            <input type="number" class="form-control" name="year" access="false" id="year" value="{{$movie->year}}">
        </div>
        <div class="mb-4 mx-4">
            <label for="description" class="">Leírás </label>
            <textarea type="textarea" class="form-control" name="description" access="false" id="description">{{$movie->description}}</textarea>
        </div>
        <div class="mb-4 mx-4">
            <label for="length" class="">Film hossza (perc)</label>
            <input type="number" class="form-control" name="length" access="false" id="length" value="{{$movie->length}}">
        </div>

        @if (!str_contains($movie->image, "placeholder.com"))
            <div class="flex-none">
                <img src="{{ route('movies.poster', ['id' => $movie->id]) }}" alt="poster" class="w-64 lg:w-96">
            </div>
        @else
            <div class="flex-none">
                <img src="{{ $movie->image }}" alt="poster" class="w-64 lg:w-96">
            </div>
        @endif

        <label for="keptorol">Kép eltávolítása</label>
        <input type="checkbox" name="keptorol" id="keptorol">

        <div class="mb-4 mx-4">
            <label for="file" class="formbuilder-file-label">File Upload</label>
            <input type="file" class="form-control" name="file" access="false" multiple="false" id="file">
        </div>
    </div>
    <button class="mx-4 text-3xl font-bold" type="submit">Létrehozás</button>
    @method('PUT')
</form>
@if ($errors->any())
<div class="text-red-600 text-3xl">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
