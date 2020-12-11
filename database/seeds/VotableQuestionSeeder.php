<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class VotableQuestionSeeder extends Seeder
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
        $numOfUser = $users->count();
        $vote = [1, -1];
        foreach (Question::all() as $question)
        {
            for($i = 1; $i <= rand(1, $numOfUser); $i++)
            {
                $users[$i - 1]->voteQuestion($question, $vote[rand(0,1)]);
            }
        }
    }
}
