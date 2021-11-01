<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Rating;
use Auth;

class MovieController extends Controller
{
    public static function getData()
    {
        $movies = Movie::latest()->paginate(10);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public static function show($id, $message="")
    {
        if (!$message)
        {
            $message = "";
        }
        $movie = Movie::find($id);
        $ratings = Rating::where("movie_id", $id)->orderBy('created_at', 'desc')->paginate(10);

        if (Auth::user()) {
            $current_users_rating = Rating::where("movie_id", $id)->where("user_id", Auth::user()->id)->get();

            if (empty($current_users_rating->all())) {
                $ex_rating = 1;
                $ex_comment = "";
            } else {
                $ex_rating = $current_users_rating[0]->rating;
                $ex_comment = $current_users_rating[0]->comment;
            }
        } else {
            $ex_comment = "";
            $ex_rating = 5;
        }
       
        return view('movies.show', compact('movie', 'ratings', 'ex_rating', 'ex_comment', 'message'));
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
