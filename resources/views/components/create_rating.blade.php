<h2 class="text-3xl">Értékelés {{ $existing_comment == '' ? ' írása' : ' módosítása'}}</h2>
<form method="POST" action="{{ route('ratings.store')}}"  enctype="multipart/form-data">
    @csrf
    <label for="rating">értékelés:</label>

<select name="rating" id="rating">
  @for ($i = 1; $i <= 5; $i++)
    <option {{ $existing_rating == $i ? 'selected=selected' : ''}} value="{{ $i }}">{{ $i }} csillag</option> 
  @endfor
</select>

<textarea name="comment" id="comment">{{ $existing_comment }}</textarea>
    <button type="submit">Elküldöm</button>
</form>