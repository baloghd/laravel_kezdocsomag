@include("layout.header")
@include("layouts.navigation")


<form action="{{ route('movies.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="rendered-form">
        <div class="  ">
            <label for="title" class="">Cím</label>
            <input type="text" class="form-control" name="title" access="false" id="title">
        </div>
        <div class="  ">
            <label for="director" class="">Rendező</label>
            <input type="text" class="form-control" name="director" access="false" id="director">
        </div>
        <div class="  ">
            <label for="year" class="">Év </label>
            <input type="number" class="form-control" name="year" access="false" id="year">
        </div>
        <div class="  ">
            <label for="description" class="">Leírás </label>
            <textarea type="textarea" class="form-control" name="description" access="false" id="description"></textarea>
        </div>
        <div class="  ">
            <label for="length" class="">Film hossza (perc)</label>
            <input type="number" class="form-control" name="length" access="false" id="length">
        </div>
        <div class="  ">
            <label for="file" class="formbuilder-file-label">File Upload</label>
            <input type="file" class="form-control" name="file" access="false" multiple="false" id="file">
        </div>
    </div>
    <button type="submit">Létrehozás</button>
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
