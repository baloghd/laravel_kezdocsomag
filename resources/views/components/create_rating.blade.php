<h2 class="text-3xl">Értékelés {{ $existing_comment == '' ? ' írása' : ' módosítása'}}</h2>
<form method="POST" action="{{ route('ratings.store')}}"  enctype="multipart/form-data">
    @csrf
    <label class="float-left mr-4" for="rating">értékelés:</label>

<select class="block w-1/5" name="rating" id="rating">
  @for ($i = 1; $i <= 5; $i++)
    <option {{ $existing_rating == $i ? 'selected=selected' : ''}} value="{{ $i }}">{{ $i }} csillag</option> 
  @endfor
</select>
<input type="hidden" name="movie_id" id="movie_id" value="{{$movie_id}}">
<textarea class="block w-1/5 mt-4" rows=5 name="comment" id="comment">{{ $existing_comment }}</textarea>
    <button class="font-bold text-3xl text-blue-700" type="submit">Elküldöm</button>

    @if ($errors->any())
    <div class="text-red-600 text-3xl">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  @if (isset($_GET["s"]) && ($_GET["s"] == "1"))
    <div class="text-green-600 text-3xl">
      Az értékelés módosítása sikeres.
    </div>
  @endif

</form>