@include("layout.header")
@include("layouts.navigation")
<h1 class="text-4xl mb-4 mx-4">Új film létrehozása </h1>
<form action="{{ route('movies.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="rendered-form">
        <div class="mx-4 mb-4">
            <label for="title" class="">Cím</label>
            <input type="text" class="form-control" name="title" access="false" id="title" value="{{old('title')}}">
        </div>
        <div class="mx-4 mb-4">
            <label for="director" class="">Rendező</label>
            <input type="text" class="form-control" name="director" access="false" id="director" value="{{old('director')}}">
        </div>
        <div class="mx-4 mb-4">
            <label for="year" class="">Év </label>
            <input type="number" class="form-control" name="year" access="false" id="year" value="{{old('year')}}">
        </div>
        <div class="mx-4 mb-4">
            <label for="description" class="">Leírás </label>
            <textarea type="textarea" class="form-control" name="description" access="false" id="description">{{old('description')}}</textarea>
        </div>
        <div class="mx-4 mb-4">
            <label for="length" class="">Film hossza (perc)</label>
            <input type="number" class="form-control" name="length" access="false" id="length" value="{{old('length')}}">
        </div>
        <div class="mx-4 mb-4">
            <label for="file" class="formbuilder-file-label">File Upload</label>
            <input type="file" class="form-control" name="file" access="false" multiple="false" id="file">
        </div>
    </div>
    <button class="mx-4 text-3xl font-bold" type="submit">Létrehozás</button>
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
