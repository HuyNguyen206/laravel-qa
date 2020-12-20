<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerResource;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
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
        try {
            $vote= $request->vote;
            \Auth::user()->voteAnswer($answer, $vote);
                return response()->json(['code' => 200, 'model'=> new AnswerResource($answer)], 200);
        }
        catch (\Throwable $ex) {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);
        }
    }
}
