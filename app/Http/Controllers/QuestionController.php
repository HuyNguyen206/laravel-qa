<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::with('user')->latest()->paginate(5);
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('question.create');
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
            Auth::user()->questions()->create($request->only('title', 'body'));
            return redirect()->route('questions.index')->with('success', 'You question has been submitted');
        }
        catch (\Throwable $ex)
        {
            return redirect()->route('questions.index')->with('fail', $ex->getMessage());
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
        //
       $question->increment('views');
       return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
        $this->authorize('update', $question);
        return view('question.edit', compact('question'));

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
            return redirect()->route('questions.index')->with('success', 'Your question has been updated');
        }
        catch (\Throwable $ex)
        {
            return redirect()->route('questions.index')->with('fail', $ex->getMessage());
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
            return redirect()->back()->with('success', 'Your question has been deleted');
        }
        catch (\Throwable $ex)
        {
            return redirect()->back()->with('fail', $ex->getMessage());
        }


    }
}
