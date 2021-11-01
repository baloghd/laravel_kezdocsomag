<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Movie;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // hány filmet generálunk
        $n_movie = 50;
        $n_user = 50;

        Movie::factory($n_movie)->create();

        $users = collect();
        $ratings_by_movie_id = collect();
        for ($i=1; $i < $n_user; $i++) { 
            $usr = User::factory()->create([
                'name' => 'user'.$i,
                'email' => 'user'.$i.'@szerveroldali.hu'
            ]);
            $users->add($usr);

            $r = range(1, $n_movie);
            shuffle($r);
            // minden felhasználó 5 és 20 db közötti filmet értékel
            $ratings_by_movie_id[$i] = array_slice($r, 0, rand(5, 20));

            foreach($ratings_by_movie_id[$i] as $m) {
                    Rating::factory()->create([
                        'user_id' => $i,
                        'movie_id' => $m
                    ]);
            }
        }

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@szerveroldali.hu'
        ]);
    }
}
