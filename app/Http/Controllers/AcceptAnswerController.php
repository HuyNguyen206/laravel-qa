<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Answer $answer)
    {
        //
        $this->authorize('acceptBestAnswer', $answer->question);
        $question = $answer->question;
        $question->best_answer_id = $answer->id;
        $question->save();
        return back();
    }
}
