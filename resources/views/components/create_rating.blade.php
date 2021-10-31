<h2 class="text-3xl">Értékelés írása</h2>
<form method="POST" action="{{ route('ratings.store')}}"  enctype="multipart/form-data">
    @csrf
    <label for="rating">értékelés:</label>

<select name="rating" id="rating">
  <option value="1">1 csillag</option>
  <option value="2">2 csillag</option>
  <option value="3">3 csillag</option>
  <option value="4">4 csillag</option>
  <option value="5">5 csillag</option>
</select>

<textarea name="comment" id="comment"></textarea>
    <button type="submit">Elküldöm</button>
</form>