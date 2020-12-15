<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
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
    public function __invoke(Request $request, Answer $answer)
    {
        //
        try {
            $vote= $request->vote;
            \Auth::user()->voteAnswer($answer, $vote);
            if($request->expectsJson())
            {
                return response()->json(['code' => 200, 'model'=> $answer], 200);
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
