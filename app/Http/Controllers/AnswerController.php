<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Question $question)
    {
        return $question->answers()->with('user')->simplePaginate(3);
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
            $question->answers()->create(['body' => $request->body, 'user_id' => \Auth::id()]);
            return redirect()->back()->with('success', 'Your answer has been submitted');
        }
        catch (\Throwable $ex)
        {
            return redirect()->back()->with('fail', $ex->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        //
        $this->authorize('update', $answer);
        // return the view of answer
        return view('answer.edit', compact('question', 'answer'));
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
        //
        //
        $this->authorize('update', $answer);
        $request->validate([
            'body' => 'required'
        ]);
        try {
            $answer->update($request->only('body'));
            if($request->expectsJson())
            {
                return response()->json(['code' => 200, 'message' => 'Your answer has been updated', 'body_html' => $answer->body_html], 200);
            }
           else
               return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated');
        }
        catch(\Throwable $ex)
        {
            if($request->expectsJson()) {
                return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);
            }
            else
                return redirect()->back()->with('fail', $ex->getMessage());
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
            if(\request()->expectsJson())
            {
                return response()->json(['code'=> 200, 'message' => 'Your answer has been deleted'], 200);
            }
            else
            {
                return redirect()->back()->with('success', 'Your answer has been deleted');
            }

        }
        catch(\Throwable $ex)
        {
            if(\request()->expectsJson()) {
                return response()->json(['code'=> 500, 'message' => $ex->getMessage()], 500);
            }
            else
            {
                return redirect()->back()->with('fail', $ex->getMessage());
            }

        }

    }
}
