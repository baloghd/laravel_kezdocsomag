<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

use Auth;


class RatingController extends Controller
{
    public function getData()
    {
        $ratings = Rating::latest()->paginate(10);
        return view('ratings.index', compact('ratings'));
    }

    public static function getMoviesWithRatings() {
        $ratings = Rating::query()
        ->selectRaw('movie_id, AVG(rating) as avg_rating')
        ->groupBy("movie_id")
        ->latest()
        ->paginate(10);

        return view('movies.index', compact("ratings"));

    }

    public static function deleteAllRatingsFromMovie($id)
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('login');
        }

        Rating::where('movie_id', "=", $id)->delete();


        return MovieController::show($id);
    }

    public function create()
    {


    }

    public function store(Request $request)
    {
        if (!Auth::user()) {
            return abort(403);
        }

        $data = $request->validate([
            'rating'        => "integer|required",
            'comment' => "",
            'movie_id' => "required"
        ], [
            'rating.required' => "Muszáj hogy számszerű legyen az értékelés.",
            'comment.min:10' => "Legalább 10 karakter hosszú legyen."
        ]);


        $user_id = Auth::user()->id;

        $existing_rating = Rating::where('movie_id', "=", $data['movie_id'])->where('user_id', '=', $user_id);
        $modosit = true;
        if (empty($existing_rating->get()->all())) {
            $modosit = false;
            Rating::factory()->create([
                "rating" => $data['rating'],
                'comment' => $data['comment'],
                'movie_id' => $data['movie_id'],
                'user_id' => $user_id
            ]);
        } else {

            $existing_rating->update(
                [
                    "rating" => $data['rating'],
                'comment' => $data['comment']
                ]
            );
        }
      return redirect()->route('movies.show', ["movie" => $data['movie_id'], "s"=>"1"]);
      /*return  redirect(
          action('MovieController@show', [
              "movie" => $data['movie_id'],
              "message" => "Az értékelés".($modosit ? " módosítása" : " létrehozása")." sikeres."
          ]));
          */

    }

    public function show($id)
    {
        //echo Rating::where('rating', '=', $id)->get();
        /*$movie = Movie::find($id);
        $ratings = Rating::where("movie_id", $id)->orderBy('created_at', 'desc')->paginate(10);
        return view('movies.show', compact('movie', 'ratings'));*/
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy(Request $request, Rating $rating)
    {
        //

        $this->authorize('delete', $rating);

        $deleted = $rating->delete();
        if (!$deleted) {
            return abort(500);
        }

        $request->session()->flash('rating_deleted', $rating);
        return redirect()->route('movies.index');
    }
}
