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
        $question->favoriteUsers()->attach(auth()->id());
        return back();
    }

    function destroy(Question $question)
    {
        $question->favoriteUsers()->detach(auth()->id());
        return back();
    }
}
