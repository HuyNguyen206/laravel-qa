<?php

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserQuestionAnswerSeeder::class);
         $this->call(FavoritesSeeder::class);
         $this->call(VotableQuestionSeeder::class);
         $this->call(VotableAnswerSeeder::class);
    }
}
