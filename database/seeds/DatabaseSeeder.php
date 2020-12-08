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
//         $this->call(UserSeeder::class);
//         $this->call(QuestionSeeder::class);
        factory(User::class, 3)->create()->each(function($u){
            $u->questions()->saveMany(factory(Question::class, rand(3,5))->make())
                ->each(function($q){
                   $q->answers()->saveMany(factory(Answer::class, rand(3, 5))->make());
                });
        });
    }
}
