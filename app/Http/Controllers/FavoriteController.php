<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    function store(Question $question)
    {
        try {
            $question->favoriteUsers()->attach(auth()->id());
            if(\request()->expectsJson())
            {
                return response()->json(['code' => 200, 'count' => $question->favorite_counts], 200);
            }
            else
            {
                return back();
            }
        }
        catch (\Throwable $ex)
        {
            if(\request()->expectsJson())
            {
                return response()->json(['code' => 500, 'message' => $ex->getMessage()] , 500);
            }
            else
            {
                return back()->with('fail',$ex->getMessage());
            }
        }



    }

    function destroy(Question $question)
    {
        try {
            $question->favoriteUsers()->detach(auth()->id());
            if(\request()->expectsJson())
            {
                return response()->json(['code' => 200, 'count' => $question->favorite_counts], 200);
            }
            else
            {
                return back();
            }
        }
        catch (\Throwable $ex)
        {
            if(\request()->expectsJson())
            {
                return response()->json(['code' => 500, 'message' => $ex->getMessage()] , 500);
            }
            else
            {
                return back()->with('fail',$ex->getMessage());
            }
        }

    }
}
