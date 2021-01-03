<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Http\Resources\AnswerResource;
use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function index(Question $question)
    {
//        dd(123);
        $answers = $question->answers()->with('question')->simplePaginate(3);
        return AnswerResource::collection($answers);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);
        try {
            $answer = $question->answers()->create(['body' => $request->body, 'user_id' => \Auth::id()]);
            $answer->load('user');
            return response()->json(['code' => 200, 'message' => 'Your answer has been submitted', 'answer' => new AnswerResource($answer)], 200);

        }
        catch (\Throwable $ex)
        {
                return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $request->validate([
            'body' => 'required'
        ]);
        try {
            $answer->update($request->only('body'));
            return response()->json(['code' => 200, 'message' => 'Your answer has been updated', 'body_html' => $answer->body_html], 200);
        }
        catch(\Throwable $ex)
        {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        //
        $this->authorize('delete', $answer);
        // return the view of answer
        try {
            $answer->delete();
            return response()->json(['code'=> 200, 'message' => 'Your answer has been deleted'], 200);

        }
        catch(\Throwable $ex)
        {
            return response()->json(['code'=> 500, 'message' => $ex->getMessage()], 500);


        }

    }
}
