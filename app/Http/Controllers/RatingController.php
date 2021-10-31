<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function getData()
    {
        $movies = Rating::latest()->paginate(10);
        return view('ratings.index', compact('ratings'));
    }
}
