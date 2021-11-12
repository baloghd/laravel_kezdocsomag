<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Movie;
use App\Models\Rating;
use Auth;




class MovieController extends Controller
{
    /*public static function getData()
    {
        $movies = Movie::latest()->paginate(5);
        return view('movies.index', compact('movies'));
    }*/


    public static function getMoviesWithAverageRatings()
    {

        if (Auth::user() && Auth::user()->is_admin) {
            $movies = Movie::withTrashed()->get();
        } else {
            $movies = Movie::latest()->get();
        }


        $rating_averages = collect();
        foreach($movies as $movie) {
            $s = 0;
            $c = 0;
            foreach($movie->ratings()->get() as $rating) {
                $c += 1;
                $s += $rating->rating;
            }
            if ($c > 0) {
                $rating_averages[$movie->id] = $s / $c;
            } else {
                $rating_averages[$movie->id] = 0;
            }
        }

        if (Auth::user() && Auth::user()->is_admin) {
            $movies = Movie::withTrashed()->paginate(10);
        } else {
            $movies = Movie::latest()->paginate(10);
        }

        return view('movies.index', compact('movies', 'rating_averages'));
    }

    public function create()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('login');
        }

        return view('movies.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title'        => "required|",
            'director' => "required|",
            'year' => "integer|min:1870|max:2021",
            'description' => 'nullable|max:512',
            'length' => 'integer|nullable',
            'file' => 'required|mimes:jpg,png|max:2048'
        ], [
           // 'title.required' => "Muszáj hogy számszerű legyen az értékelés.",
           // 'comment.min:10' => "Legalább 10 karakter hosszú legyen."
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_hash_name'] = $file->hashName();
            #$data['file_name'] = $file->getClientOriginalName();
            Storage::disk('public')->put('posters\\' . $data['file_hash_name'], $file->get());
        }

        Movie::factory()->create(
            [
                "title" => $data['title'],
                "director" => $data['director'],
                "year" => $data['year'],
                "description" => $data['description'],
                "length" => $data['length'],
                "image" => 'posters\\' . $data['file_hash_name']
            ]
        );

        var_dump($data);

    }

    public static function show($id, $message="")
    {
        if (!$message)
        {
            $message = "";
        }

        if (Auth::user() && Auth::user()->is_admin) {
            $movie = Movie::withTrashed()->find($id);
        } else {
            $movie = Movie::latest()->find($id);
        }

        if ($movie === null) {
            abort(404, 'Nem található a film.');
        }

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
        if (!Auth::user()->is_admin) {
            return redirect()->route('login');

        }

        $movie = Movie::withTrashed()->find($id);

        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $movie)
    {

        if (!Auth::user()->is_admin) {
            return redirect()->route('login');

        }

        $data = $request->validate([
            'title'        => "required|",
            'director' => "required|",
            'year' => "integer|min:1870|max:2021",
            'description' => 'nullable|max:512',
            'length' => 'integer|nullable',
            'file' => 'mimes:jpg,png|max:2048',
            'keptorol' => ''
        ], [
           // 'title.required' => "Muszáj hogy számszerű legyen az értékelés.",
           // 'comment.min:10' => "Legalább 10 karakter hosszú legyen."
        ]);

        $movie = Movie::find($movie);

        $img_route = "";

        if ($request->has('keptorol')) {
            if (!str_contains($movie->image, "placeholder.com")) {
                Storage::disk('public')->delete($movie->image);
            }
            $img_route = "https://via.placeholder.com/300x400?text=Placeholder+filmposzter";
        }


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_hash_name'] = $file->hashName();
            #$data['file_name'] = $file->getClientOriginalName();
            Storage::disk('public')->put('posters\\' . $data['file_hash_name'], $file->get());
            $img_route = 'posters\\' . $data['file_hash_name'];

            # az előző törlése

            if (!str_contains($movie->image, "placeholder.com")) {
                Storage::disk('public')->delete($movie->image);
            }
        } else {
            if (!$request->has('keptorol')) {
                $img_route = $movie->image;
            }
        }


        $movie->update(
            [
                "title" => $data['title'],
                "director" => $data['director'],
                "year" => $data['year'],
                "description" => $data['description'],
                "length" => $data['length'],
                "image" =>$img_route
            ]
        );

        return redirect()->route("movies.show", [
            "movie" => $movie,
            "e" => 1
        ]);
    }

    public function destroy($id)
    {
        //
    }

    public function poster($id) {
        $movie = Movie::withTrashed()->find($id);
        if ($movie === null || $movie->image === null) {
            return abort(404);
        }
        return Storage::disk('public')->get($movie->image);
    }


    public function deleteratings($id) {
        $movie = Movie::withTrashed()->find($id);
        foreach ($movie->ratings()->get() as $r) {
            $r->delete();
        }


        return redirect()->route("movies.show", [
            "movie" => $movie->id,
            "t" => 1
        ]);
    }

    public function delete($id) {
        $movie = Movie::withTrashed()->find($id);
        $movie->delete();


        return redirect()->route("movies.show", [
            "movie" => $movie->id,
            "d" => 1
        ]);
    }

    public function restore($id) {
        $movie = Movie::withTrashed()->find($id);
        $movie->restore();


        return redirect()->route("movies.show", [
            "movie" => $movie->id,
            "r" => 1
        ]);
    }
}
