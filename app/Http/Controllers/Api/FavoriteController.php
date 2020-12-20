<?php

namespace App\Http\Controllers\Api;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{

    function store(Question $question)
    {
        try {
            $question->favoriteUsers()->attach(auth()->id());
            return response()->json(['code' => 200, 'count' => $question->favorite_counts], 200);
        }
        catch (\Throwable $ex)
        {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()] , 500);
        }



    }

    function destroy(Question $question)
    {
        try {
            $question->favoriteUsers()->detach(auth()->id());
            return response()->json(['code' => 200, 'count' => $question->favorite_counts], 200);
        }
        catch (\Throwable $ex)
        {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()] , 500);

        }

    }
}
