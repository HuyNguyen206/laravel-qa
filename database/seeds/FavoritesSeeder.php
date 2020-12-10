<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = User::all();
        $questions =  Question::all();
        $usersCount = $users->count();
        foreach($questions as $q)
        {
            for($i = 1; $i <= rand(1, $usersCount); $i++)
            {
                $q->favoriteUsers()->attach($users[$i - 1]);
            }
        }
    }
}
