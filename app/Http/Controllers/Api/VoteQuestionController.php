<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionDetailResource;
use App\Http\Resources\QuestionResource;
use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Question $question)
    {
        //
        try {
            $vote= $request->vote;
            \Auth::user()->voteQuestion($question, $vote);
            return response()->json(['code' => 200, 'model'=> new QuestionDetailResource($question)], 200);
        }
        catch (\Throwable $ex)
        {
             return response()->json(['code' => 500, 'message'=> $ex->getMessage()], 500);
        }
    }
}
