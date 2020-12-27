<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::with('user')->latest()->paginate(5);
//        return view('question.index', compact('questions'));
        return QuestionResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request)
    {
        //
        try {
            $question = Auth::user()->questions()->create($request->only('title', 'body'));
            return response()->json(['code' => 200, 'message' => 'You question has been submitted', 'question' => new QuestionResource( $question) ], 200);
//            return redirect()->route('questions.index')->with('success', 'You question has been submitted');
        }
        catch (\Throwable $ex)
        {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);
//            return redirect()->route('questions.index')->with('fail', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
        try {
            //
            $this->authorize('update', $question);
            $question->update($request->only('title', 'body'));
                return response()->json(
                    ['code'=>200, 'message' => 'Your question has been updated',
                        'body_html' => $question->body_html], 200);

        }
        catch (\Throwable $ex)
        {
                return response()->json(['code'=>500, 'message' => $ex->getMessage()], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
        try {
            //
            $this->authorize('delete', $question);
            $question->delete();
                return response()->json(['code' => 200, 'message' => 'Your question has been deleted'], 200);

        }
        catch (\Throwable $ex)
        {
                return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);

        }
    }
}
