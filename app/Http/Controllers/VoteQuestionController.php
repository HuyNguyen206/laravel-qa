<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            if($request->expectsJson())
            {
                return response()->json(['code' => 200, 'model'=> $question], 200);
            }
            else{
                return back();
            }
        }
        catch (\Throwable $ex)
        {
         if($request->expectsJson())
         {
             return response()->json(['code' => 500, 'message'=> $ex->getMessage()], 500);
         }
         else
         {
             return back()->with('fail', $ex->getMessage());
         }
        }
    }
}
