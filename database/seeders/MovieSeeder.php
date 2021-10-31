<?php

namespace Database\Seeders;

use Database\Factories\MovieFactory;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Rating;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory(10)->create();
        Rating::factory(100)->create();
        //
    }
}
