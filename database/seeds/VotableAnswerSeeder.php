<?php

use App\Answer;
use App\User;
use Illuminate\Database\Seeder;

class VotableAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $numOfUser = $users->count();
        $vote = [1, -1];
        foreach (Answer::all() as $a)
        {
            for($i = 1; $i <= rand(1, $numOfUser); $i++)
            {
                $users[$i - 1]->voteAnswer($a, $vote[rand(0,1)]);
            }
        }
    }
}
