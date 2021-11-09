<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use App\Models\Rating;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource("movies", MovieController::class);
Route::resource("ratings", RatingController::class);

Route::get("/movies/{id}/deleteratings", function($id) {return RatingController::deleteAllRatingsFromMovie($id);})->name("movies.deleteratings");
#Route::get("/movies/{id}/deleteratings", function($id) {echo $id;})->name("movies.deleteratings");

Route::get("/movies/{id}/poster", [MovieController::class, "poster"])->name("movies.poster");

Route::get('/', function () { return RatingController::getMoviesWithRatings();})->name("fooldal");
#Route::get('/', function () { return MovieController::getMoviesWithRatings();})->name("fooldal");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get("/toplista", function () {
    $ratings = Rating::query()
                ->selectRaw('movie_id, AVG(rating) as avg_rating')
                ->groupBy("movie_id")
                ->orderBy("avg_rating", "desc")
                ->limit(6)
                ->get();
    return view('toplista', compact("ratings"));
})->name("toplista");


//Route::post("/ratings/store", RatingController::class);
//Route::post('/ratings/store', 'RatingController@store')->name('ratings.store');
