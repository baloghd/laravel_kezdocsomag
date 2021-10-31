<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

use Auth;

class RatingController extends Controller
{
    public function getData()
    {
        $movies = Rating::latest()->paginate(10);
        return view('ratings.index', compact('ratings'));
    }

    public static function getMoviesWithRatings() {
        $ratings = Rating::query()
        ->selectRaw('movie_id, AVG(rating) as avg_rating')
        ->groupBy("movie_id")
        //->orderBy("avg_rating", "desc")
        ->latest()
        ->paginate(10);

        return view('movies.index', compact("ratings"));

    }

    public function create()
    {


    }

    public function store(Request $request)
    {
        /*$request->validate(

        )*/
        error_log('Some message here.');
      return $request;
     
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

    public function destroy($id)
    {
        //
    }
}
