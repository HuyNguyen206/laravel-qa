<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcceptAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Answer $answer)
    {
        //
        $this->authorize('acceptBestAnswer', $answer->question);
        try {
            $question = $answer->question;
            $question->best_answer_id = $answer->id;
            $question->save();
            return response()->json(['code' => 200, 'status' => $answer->status], 200);

        } catch (\Throwable $ex) {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);

        }

    }
}
